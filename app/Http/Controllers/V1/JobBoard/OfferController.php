<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\JobBoard\Company;
use App\Models\JobBoard\Offer;
use App\Models\Core\Status;
use App\Models\Core\Catalogue;
use App\Models\Core\Location;
use App\Models\Authentication\Route;
use Illuminate\Http\Request;
use App\Http\Requests\V1\JobBoard\Offer\IndexOfferRequest;
use App\Http\Requests\V1\JobBoard\Offer\StoreOfferRequest;
use App\Http\Requests\V1\JobBoard\Offer\UpdateOfferRequest;
use App\Http\Requests\V1\JobBoard\Offer\UpdateStatusOfferRequest;
use App\Http\Requests\V1\JobBoard\Offer\DeleteOfferRequest;
use App\Http\Requests\V1\JobBoard\Offer\GetProfessionalOfferRequest;
use Illuminate\Database\Eloquent\Model;

class OfferController extends Controller
{
    function index(IndexOfferRequest $request)
    {
        $company = $request->user()->company()->first();

        if ($request->has('search')) {
            $offers = $company->offers()
                ->aditionalInformation($request->input('search'))
                ->code($request->input('search'))
                ->paginate($request->input('per_page'));
        } else {
            $offers = $company->offers()->paginate($request->input('per_page'));
        }

        if ($offers->count() === 0) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'No se encontraron Ofertas',
                    'detail' => 'Intente de nuevo',
                    'code' => '404'
                ]], 404);
        }

        return response()->json($offers, 200);
    }

    function store(StoreOfferRequest $request)
    {
        $company = $request->user()->company->first();
        $location = Location::find($request->input('location.id'));
        $contractType = Catalogue::find($request->input('contractType.id'));
        $position = Catalogue::find($request->input('position.id'));
        $sector = Catalogue::find($request->input('sector.id'));
        $workingDay = Catalogue::find($request->input('workingDay.id'));
        $experienceTime = Catalogue::find($request->input('experienceTime.id'));
        $trainingHours = Catalogue::find($request->input('trainingHours.id'));
        $status = Status::find($request->input('status.id'));
        $lastOffer = Offer::get()->last();
        $number = $lastOffer?$lastOffer->id + 1:1;

        $offer = new Offer;
        $offer->code = $company->prefix.$number;
        $offer->contact_name = $request->input('contactName');
        $offer->contact_email = $request->input('contactEmail');
        $offer->contact_phone = $request->input('contactPhone');
        $offer->contact_cellphone = $request->input('contactCellphone');
        $offer->remuneration = $request->input('remuneration');
        $offer->vacancies = $request->input('vacancies');
        $offer->started_at = $request->input('startedAt');
        $offer->ended_at = $this->calculateEndOffer($request->input('startedAt'));
        $offer->activities = $request->input('activities');
        $offer->requirements = $request->input('requirements');
        $offer->aditional_information = $request->input('aditionalInformation');
        $offer->company()->associate($company);
        $offer->location()->associate($location);
        $offer->contractType()->associate($contractType);
        $offer->position()->associate($position);
        $offer->sector()->associate($sector);
        $offer->workingDay()->associate($workingDay);
        $offer->experienceTime()->associate($experienceTime);
        $offer->trainingHours()->associate($trainingHours);
        $offer->status()->associate($status);

        DB::transaction(function () use($offer, $request) {
            $offer->save();
            $offer->categories()->attach($request->input('categories'));
        });


        return response()->json([
            'data' => $offer->refresh(),
            'msg' => [
                'summary' => 'Oferta creada',
                'detail' => 'El registro fue creado',
                'code' => '201'
            ]
        ], 201);
    }

    function show(Offer $offer)
    {
        return response()->json([
            'data' => $offer,
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]], 200);
    }

    function getProfessionals(GetProfessionalOfferRequest $request, Offer $offer)
    {
        $professionals = $offer->professionals()->paginate($request->input('per_page'));;
        return response()->json($professionals, 200);
    }

    function update(UpdateOfferRequest $request, Offer $offer)
    {
        $location = Location::find($request->input('location.id'));
        $contractType = Catalogue::find($request->input('contract_type.id'));
        $position = Catalogue::find($request->input('position.id'));
        $sector = Catalogue::find($request->input('sector.id'));
        $workingDay = Catalogue::find($request->input('working_day.id'));
        $experienceTime = Catalogue::find($request->input('experience_time.id'));
        $trainingHours = Catalogue::find($request->input('training_hours.id'));
        $status = Status::find($request->input('status.id'));

        $offer->contact_name = $request->input('contactName');
        $offer->contact_email = $request->input('contactEmail');
        $offer->contact_phone = $request->input('contactPhone');
        $offer->contact_cellphone = $request->input('contactCellphone');
        $offer->remuneration = $request->input('remuneration');
        $offer->vacancies = $request->input('vacancies');
        $offer->started_at = $request->input('startedAt');
        $offer->ended_at = $this->calculateEndOffer($request->input('startedAt'));
        $offer->activities = $request->input('activities');
        $offer->requirements = $request->input('requirements');
        $offer->aditional_information = $request->input('aditionalInformation');
        $offer->location()->associate($location);
        $offer->contractType()->associate($contractType);
        $offer->position()->associate($position);
        $offer->sector()->associate($sector);
        $offer->workingDay()->associate($workingDay);
        $offer->workingDay()->associate($workingDay);
        $offer->experienceTime()->associate($experienceTime);
        $offer->trainingHours()->associate($trainingHours);
        $offer->status()->associate($status);

        DB::transaction(function () use($offer, $request) {
            $offer->categories()->detach();
            $offer->save();
            $offer->categories()->attach($request->input('categories'));
        });

        return response()->json([
            'data' => $offer->refresh(),
            'msg' => [
                'summary' => 'Oferta actualizada',
                'detail' => 'El registro fue actualizado',
                'code' => '201'
            ]], 201);
    }

    function delete(DeleteOfferRequest $request)
    {
        Offer::destroy($request->input('ids'));

        return response()->json([
            'data' => null,
            'msg' => [
                'summary' => 'Oferta eliminadas',
                'detail' => 'El registro fue eliminado',
                'code' => '201'
            ]], 201);
    }

    function changeStatus(UpdateStatusOfferRequest $request, Offer $offer){
        $offer->status()->associate(Status::find($request->input('status.id')));
        $offer->save();
        return response()->json([
            'data' => $offer,
            'msg' => [
                'summary' => 'Estado cambio',
                'detail' => 'El registro fue actualizado',
                'code' => '201'
            ]], 201);
    }

    function getStatus(Request $request){
        $route = Route::where('uri',$request->input('uri'))->first();
        $status = $route->status()->get();
        return response()->json([
            'data' => $status,
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]
        ], 201);
    }

    private function calculateEndOffer($startedAt){
        return (Carbon::createFromFormat('Y-m-d', $startedAt))->addMonth();
    }
}
