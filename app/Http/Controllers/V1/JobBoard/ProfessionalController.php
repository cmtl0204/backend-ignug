<?php

namespace App\Http\Controllers\V1\JobBoard;

//Controllers
use App\Http\Controllers\Controller;

//Models
use App\Http\Requests\V1\JobBoard\Professional\RegistrationProfessionalRequest;
use App\Http\Requests\V1\JobBoard\Professional\UpdateProfileRequest;
use App\Http\Resources\V1\JobBoard\ProfileResource;
use App\Models\Authentication\User;
use App\Models\Core\Catalogue;
use App\Models\Core\Address;
use App\Models\JobBoard\Professional;
use App\Models\Core\Location;

// FormRequest
use Dyrynda\Database\Support\CascadeSoftDeleteException;
use Illuminate\Http\Request;
use App\Http\Requests\V1\JobBoard\Professional\UpdateProfessionalRequest;
use Intervention\Image\Facades\Image as InterventionImage;

class ProfessionalController extends Controller
{
    function getProfile(Professional $professional)
    {
        return (new ProfileResource($professional))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function getCurriculum(GetProfessionalRequest $request)
    {

        $professional = $request->user()->professional()->with(['languages', 'experiences', 'references', 'skills', 'courses', 'user' => function ($user) {
            $user->with('gender', 'sex')
                ->with(['address' => function ($address) {
                    $address->with([
                        'location' => function ($location) {
                            $location->with('parent');
                        }, 'sector'
                    ]);
                }]);
        }])->first();
        if (!$professional) {
            return response()->json([
                'data' => $professional,
                'msg' => [
                    'summary' => 'professional no encontrada',
                    'detail' => 'Vuelva a intentar',
                    'code' => '404',
                ]
            ], 404);
        }
        // $course = $professional->course()->with('professional')->first();
        // $skill = $professional->skill()->with('professional')->first();

        return response()->json([
            'data' => $professional,
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200',
            ]
        ], 200);
    }

    function updateProfile(UpdateProfileRequest $request, Professional $professional)
    {
//        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        $user = $professional->user()->first();
//        $address = $user->address()->first() ? $user->address()->first() : new Address();
//        $location = Location::find($request->input('professional.user.address.location.id'));
//        $sector = Catalogue::find($request->input('professional.user.address.sector.id'));
//        $address->main_street = $request->input('professional.user.address.main_street');
//        $address->secondary_street = $request->input('professional.user.address.secondary_street');
//        $address->number = $request->input('professional.user.address.number');
//        $address->post_code = $request->input('professional.user.address.post_code');
//        $address->reference = $request->input('professional.user.address.reference');
//        $address->longitude = $request->input('professional.user.address.longitude');
//        $address->latitude = $request->input('professional.user.address.latitude');
//        $address->location()->associate($location);
//        $address->sector()->associate($sector);
//        $address->save();

        $identificationType = Catalogue::find($request->input('user.identificationType.id'));
        $sex = Catalogue::find($request->input('user.sex.id'));
        $gender = Catalogue::find($request->input('user.gender.id'));
        $bloodType = Catalogue::find($request->input('user.bloodType.id'));
        $ethnicOrigin = Catalogue::find($request->input('user.ethnicOrigin.id'));

        $user->username = $request->input('user.username');
        $user->email = $request->input('user.email');
        $user->name = $request->input('user.name');
        $user->lastname = $request->input('user.lastname');
        $user->phone = $request->input('user.phone');
        $user->birthdate = $request->input('user.birthdate');
        //        $user->address()->associate($address);

        $user->identificationType()->associate($identificationType);
        $user->sex()->associate($sex);
        $user->gender()->associate($gender);
        $user->bloodType()->associate($bloodType);
        $user->ethnicOrigin()->associate($ethnicOrigin);
        $user->save();

        $professional->traveled = $request->input('traveled');
        $professional->disabled = $request->input('disabled');
        $professional->familiar_disabled = $request->input('familiarDisabled');
        $professional->identification_familiar_disabled = $request->input('identificationFamiliarDisabled');
        $professional->catastrophic_diseased = $request->input('catastrophicDiseased');
        $professional->familiar_catastrophic_diseased = $request->input('familiarCatastrophicDiseased');
        $professional->about_me = $request->input('aboutMe');
        $professional->save();

        return (new ProfileResource($professional))
            ->additional([
                'msg' => [
                    'summary' => 'Registro actualizado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    function registration(RegistrationProfessionalRequest $request)
    {
//        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        $user = new User();
//        $address = $user->address()->first() ? $user->address()->first() : new Address();
//        $location = Location::find($request->input('professional.user.address.location.id'));
//        $sector = Catalogue::find($request->input('professional.user.address.sector.id'));
//        $address->main_street = $request->input('professional.user.address.main_street');
//        $address->secondary_street = $request->input('professional.user.address.secondary_street');
//        $address->number = $request->input('professional.user.address.number');
//        $address->post_code = $request->input('professional.user.address.post_code');
//        $address->reference = $request->input('professional.user.address.reference');
//        $address->longitude = $request->input('professional.user.address.longitude');
//        $address->latitude = $request->input('professional.user.address.latitude');
//        $address->location()->associate($location);
//        $address->sector()->associate($sector);
//        $address->save();

        $identificationType = Catalogue::find($request->input('user.identificationType.id'));
        $sex = Catalogue::find($request->input('user.sex.id'));
        $gender = Catalogue::find($request->input('user.gender.id'));
        $bloodType = Catalogue::find($request->input('user.bloodType.id'));
        $ethnicOrigin = Catalogue::find($request->input('user.ethnicOrigin.id'));

        $user->username = $request->input('user.username');
        $user->password = $request->input('user.password');
        $user->email = $request->input('user.email');
        $user->name = $request->input('user.name');
        $user->lastname = $request->input('user.lastname');
        $user->phone = $request->input('user.phone');
        $user->birthdate = $request->input('user.birthdate');
        //        $user->address()->associate($address);

        $user->identificationType()->associate($identificationType);
        $user->sex()->associate($sex);
        $user->gender()->associate($gender);
        $user->bloodType()->associate($bloodType);
        $user->ethnicOrigin()->associate($ethnicOrigin);
        $user->save();

        $professional = new Professional();
        $professional->user()->associate($user);
        $professional->traveled = $request->input('traveled');
        $professional->disabled = $request->input('disabled');
        $professional->familiar_disabled = $request->input('familiarDisabled');
        $professional->identification_familiar_disabled = $request->input('identificationFamiliarDisabled');
        $professional->catastrophic_diseased = $request->input('catastrophicDiseased');
        $professional->familiar_catastrophic_diseased = $request->input('familiarCatastrophicDiseased');
        $professional->about_me = $request->input('aboutMe');
        $professional->save();

        return (new ProfileResource($professional))
            ->additional([
                'msg' => [
                    'summary' => 'Registro creado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    function generateCertificate($username)
    {
        $data = User::firstWhere('username', $username);

        if (!$data) {
            return view('reports.professional.no-registration');
        }
//        $message = 'https://bolsa-empleo.yavirac.edu.ec/professional/validate-certificate/' . $data->username;
        $message = 'http://backend-ignug.test/professional/validate-certificate/' . $data->username;
        \QrCode::format('png')
            ->gradient(93, 222, 244, 0, 124, 145, 'diagonal')
            ->size(150)
            ->generate($message, '../public/qr/' . $data->id . '.png');

        $pdf = \PDF::loadView('reports.professional.registration-certificate', ['data' => $data]);
        return $pdf->stream('certificate-' . $data->username . '.pdf');
    }

    function getCertificate($username)
    {
        $data = User::firstWhere('username', $username);
        if (!$data) {
            return view('reports.professional.no-registration');
        }

        return view('reports.professional.validate-certificate', ['data' => $data]);
    }
}
