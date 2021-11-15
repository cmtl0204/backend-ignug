<?php

namespace Database\Seeders;

use App\Models\Core\Catalogue;
use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Category;
use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Experience;
use App\Models\JobBoard\Language;
use App\Models\JobBoard\Reference;
use App\Models\JobBoard\Skill;
use App\Models\JobBoard\Course;
use App\Models\JobBoard\Company;
use App\Models\JobBoard\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createProfessionalCatalogues();
        $this->createCategories();
        $this->createProfessionalDegrees();
        $this->createProfessionals();
//        $this->createAcademicFormations();
//        $this->createLanguages();
//        $this->createReferences();
//        $this->createSkills();
//        $this->createCourses();
//        $this->createExperiences();
//        $this->createCompanies();
        // $this->createOffers();
//        $this->createCategoryOffers();
//        $this->createCompanyProfessionals();
//        $this->createOfferProfessionals();
    }

    private function createProfessionalCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory(8)->sequence(
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'CONFERENCIA'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'CONGRESO'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'JORNADA'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'PANEL'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'PASANTIA'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'SEMINARIO'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'TALLER'
            ],
            [
                'type' => $catalogues['catalogue']['course_event_type']['type'],
                'name' => 'VISTA DE OBSERVACION'
            ]
        )->create();

        Catalogue::factory(2)->sequence(
            [
                'type' => $catalogues['catalogue']['course_certification_type']['type'],
                'name' => 'APROBACION'
            ],
            [
                'type' => $catalogues['catalogue']['course_certification_type']['type'],
                'name' => 'ASISTENCIA'
            ]
        )->create();

        Catalogue::factory()->count(20)->create([
            'type' => $catalogues['catalogue']['course_area']['type']
        ]);

        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['experience_area']['type']
        ]);

        Catalogue::factory(2)->sequence(
            [
                'type' => $catalogues['catalogue']['skill_type']['type'],
                'name' => 'HABILIDAD BLANDA'
            ],
            [
                'type' => $catalogues['catalogue']['skill_type']['type'],
                'name' => 'HABILIDAD DURA'
            ]
        )->create();

        Catalogue::factory(11)->sequence(
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'CHINO MANDARIN'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'ESPAÑOL'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'INGLES'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'ARABE'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'PORTUGUES'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'RUSO'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'JAPONES'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'ALEMAN'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'COREANO'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'FRANCES'
            ],
            [
                'type' => $catalogues['catalogue']['language_idiom']['type'],
                'name' => 'ITALIANO'
            ]
        )->create();

        Catalogue::factory(3)->sequence(
            [
                'type' => $catalogues['catalogue']['language_written_level']['type'],
                'code' => '1',
                'name' => 'BASICO'
            ],
            [
                'type' => $catalogues['catalogue']['language_written_level']['type'],
                'code' => '2',
                'name' => 'INTERMEDIO'
            ],
            [
                'type' => $catalogues['catalogue']['language_written_level']['type'],
                'code' => '3',
                'name' => 'AVANZADO'
            ],
        )->create();

        Catalogue::factory(3)->sequence(
            [
                'type' => $catalogues['catalogue']['language_spoken_level']['type'],
                'code' => '1',
                'name' => 'BASICO'
            ],
            [
                'type' => $catalogues['catalogue']['language_spoken_level']['type'],
                'code' => '2',
                'name' => 'INTERMEDIO'
            ],
            [
                'type' => $catalogues['catalogue']['language_spoken_level']['type'],
                'code' => '3',
                'name' => 'AVANZADO'
            ],
        )->create();

        Catalogue::factory(3)->sequence(
            [
                'type' => $catalogues['catalogue']['language_read_level']['type'],
                'code' => '1',
                'name' => 'BASICO'
            ],
            [
                'type' => $catalogues['catalogue']['language_read_level']['type'],
                'code' => '2',
                'name' => 'INTERMEDIO'
            ],
            [
                'type' => $catalogues['catalogue']['language_read_level']['type'],
                'code' => '3',
                'name' => 'AVANZADO'
            ],
        )->create();

        Catalogue::factory()->count(3)->create([
            'type' => $catalogues['catalogue']['company_type']['type']
        ]);

        Catalogue::factory()->count(3)->create([
            'type' => $catalogues['catalogue']['company_activity_type']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['company_person_type']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['offer_contract_type']['type']
        ]);

        Catalogue::factory()->count(3)->create([
            'type' => $catalogues['catalogue']['offer_sector']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['offer_working_day']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['offer_training_hours']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['offer_experience_time']['type']
        ]);
    }

    private function createCategories()
    {
        Category::factory(9)->sequence(
            [
                'name' => 'EDUCACION'
            ],
            [
                'name' => 'CIENCIAS SOCIALES, PERIODISMO E INFORMACION'
            ],
            [
                'name' => 'ADMINISTRACION'
            ],
            [
                'name' => 'CIENCIAS NATURALES, MATEMATICAS Y ESTADISTICA'
            ],
            [
                'name' => 'TECNOLOGIAS DE LA INFORMACION Y LA COMUNICACION (TIC)'
            ],
            [
                'name' => 'INGENIERIA, INDUSTRIA Y CONSTRUCCION'
            ],
            [
                'name' => 'AGRICULTURA, SILVICULTURA, PESCA Y VETERINARIA'
            ],
            [
                'name' => 'SALUD Y BIENESTAR'
            ],
            [
                'name' => 'SERVICIOS'
            ]
        )->create();
    }

    private function createProfessionalDegrees()
    {
        Category::factory(218)->sequence(
            ['parent_id'=>1,'name'=>'ASISTENTE PEDAGOGICO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>1,'name'=>'ASISTENTE EN EDUCACION INCLUSIVA CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR Y CONDUCTOR DE RADIO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR Y CONDUCTOR DE TELEVISION CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR RADIOFONICO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR RADIAL COMUNITARIO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR EN COMUNICACION AUDIOVISUAL CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR EN TELEVISION COMUNITARIA CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR EN MULTIMEDIA CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR DE SONIDO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'LOCUTOR CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'PRODUCTOR DE MEDIOS IMPRESOS CON NIVEL EQUIVALENTE A TECNOLOGOSUPERIOR'],
            ['parent_id'=>2,'name'=>'COMUNICADOR DIGITAL CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'GRAFOLOGO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>2,'name'=>'TECNOLOGO SUPERIOR EN CRIMINALISTICA'],
            ['parent_id'=>2,'name'=>'TECNOLOGO SUPERIOR EN CRIMINOLOGIA'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN TRIBUTACION'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN AUDITORIA'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN CONTABILIDAD'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN SEGUROS Y RIESGOS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN ADMINISTRACION FINANCIERA'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR EN ADMINISTRACION'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN ADMINISTRACION'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN GESTION DEL PATRIMONIO HISTORICO CULTURAL'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN GESTION DE OPERACIONES TURISTICAS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN GESTION PUBLICA'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN MARKETING'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN PUBLICIDAD'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR EN OPERACION DE CENTRALES TELEFONICAS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN PROMOCION CULTURAL'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR SUPERIOR EN ASISTENCIA ADMINISTRATIVA'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN ASISTENCIA ADMINISTRATIVA'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR EN SECRETARIADO EJECUTIVO'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN SECRETARIADO EJECUTIVO'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR EN VENTAS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN VENTAS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN COMERCIO EXTERIOR'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR EN BIENES RAICES'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN BIENES RAICES'],
            ['parent_id'=>3,'name'=>'TECNICO SUPERIOR EN GESTION DE PRODUCCION Y SERVICIOS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN GESTION DE PRODUCCION Y SERVICIOS'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN GESTION DEL TALENTO HUMANO'],
            ['parent_id'=>3,'name'=>'TECNOLOGO SUPERIOR EN FORMACION OCUPACIONAL POR COMPETENCIAS'],
            ['parent_id'=>4,'name'=>'TECNOLOGO SUPERIOR EN BIOTECNOLOGIA'],
            ['parent_id'=>4,'name'=>'TECNICO SUPERIOR EN PROTECCION DEL MEDIO AMBIENTE'],
            ['parent_id'=>4,'name'=>'TECNOLOGO SUPERIOR EN PROTECCION DEL MEDIO AMBIENTE'],
            ['parent_id'=>4,'name'=>'TECNICO SUPERIOR EN DESARROLLO AMBIENTAL'],
            ['parent_id'=>4,'name'=>'TECNOLOGO SUPERIOR EN DESARROLLO AMBIENTAL'],
            ['parent_id'=>4,'name'=>'TECNOLOGO SUPERIOR EN PROMOCION DE ENERGIAS RENOVABLES'],
            ['parent_id'=>4,'name'=>'TECNOLOGO SUPERIOR FORESTAL'],
            ['parent_id'=>4,'name'=>'GUARDAPARQUES CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>4,'name'=>'TOPOGRAFO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>4,'name'=>'ANALISTA DE SUELOS CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>5,'name'=>'TECNICO SUPERIOR EN ENSAMBLAJE Y MANTENIMIENTO DE EQUIPOS DE COMPUTO'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN ENSAMBLAJE Y MANTENIMIENTO DE EQUIPOS DE COMPUTO'],
            ['parent_id'=>5,'name'=>'TECNICO SUPERIOR EN GESTION DE BASES DE DATOS'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN DISEÑO Y GESTION DE BASE DE DATOS'],
            ['parent_id'=>5,'name'=>'TECNICO SUPERIOR EN INSTALACION Y MANTENIMIENTO DE REDES'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN DISEÑO Y MANTENIMIENTO DE REDES'],
            ['parent_id'=>5,'name'=>'TECNICO SUPERIOR EN REDES Y TELECOMUNICACIONES'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN REDES Y TELECOMUNICACIONES'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN DESARROLLO DE SOFTWARE'],
            ['parent_id'=>5,'name'=>'AUDITOR DE SISTEMAS CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>5,'name'=>'AUDITOR DE SISTEMAS CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN DESARROLLO DE APLICACIONES MOVILES'],
            ['parent_id'=>5,'name'=>'TECNOLOGO SUPERIOR EN DESARROLLO DE APLICACIONES WEB'],
            ['parent_id'=>5,'name'=>'TECNICO SUPERIOR EN MANTENIMIENTO DE SOFTWARE'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN POLIMEROS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN QUIMICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MEDICION Y MONITOREO AMBIENTAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN TRATAMIENTO DE DESECHOS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ELECTRICIDAD Y POTENCIA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ELECTRICIDAD'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ENERGIAS ALTERNATIVAS'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN MANTENIMIENTO ELECTRICO Y CONTROL INDUSTRIAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MANTENIMIENTO ELECTRICO Y CONTROL INDUSTRIAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ELECTRONICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ELECTROMECANICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ELECTROMECANICA AUTOMOTRIZ'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN AUTOMATIZACION E INSTRUMENTACION'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN AUTOMATIZACION E INSTRUMENTACION'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN ELECTRONICA EN INSTRUMENTACION AVIONICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ELECTRONICA EN INSTRUMENTACION AVIONICA'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN TELEMATICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN TELEMATICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN SOLDADURA'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN ENDEREZADA Y PINTURA AUTOMOTRIZ'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN METALMECANICA'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN METALMECANICA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MECANICA AERONAUTICA'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN MECANICA NAVAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MECANICA NAVAL'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN MECANICA AUTOMOTRIZ'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MECANICA AUTOMOTRIZ'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN MECANICA INDUSTRIAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MECANICA INDUSTRIAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN REFRIGERACION Y AIRE ACONDICIONADO'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MANTENIMIENTO MECANICO'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN MANTENIMIENTO MECANICO'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN SISTEMAS DE INYECCION A GASOLINA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN SISTEMAS DE INYECCION A DIESEL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MANTENIMIENTO Y REPARACION DE MOTORES A DIESEL Y GASOLINA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MECATRONICA AUTOMOTRIZ'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PROCESAMIENTO DE ALIMENTOS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN ENOLOGIA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PROCESAMIENTO INDUSTRIAL DE LA MADERA'],
            ['parent_id'=>6,'name'=>'CARPINTERO CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>6,'name'=>'CARPINTERO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PROCESAMIENTO INDUSTRIAL DEL VIDRIO'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PROCESAMIENTO INDUSTRIAL DEL PLASTICO'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PROCESAMIENTO DE CUERO'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PRODUCCION TEXTIL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN FABRICACION DE CALZADO'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN CONFECCION TEXTIL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PETROLEOS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MINERIA'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN PRODUCCION INDUSTRIAL'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN MECANICA Y OPERACION DE MAQUINAS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MECANICA Y OPERACION DE MAQUINAS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN IMPRESION OFFSET Y ACABADOS'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN GESTION DE LA CALIDAD'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN MANTENIMIENTO Y SEGURIDAD INDUSTRIAL'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN CATASTROS'],
            ['parent_id'=>6,'name'=>'TECNICO SUPERIOR EN OBRAS CIVILES'],
            ['parent_id'=>6,'name'=>'TECNOLOGO SUPERIOR EN CONSTRUCCION'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN PERMACULTURA'],
            ['parent_id'=>7,'name'=>'TECNICO SUPERIOR EN AGROECOLOGIA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN AGROECOLOGIA'],
            ['parent_id'=>7,'name'=>'TECNICO SUPERIOR EN PRODUCCION AGRICOLA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN PRODUCCION AGRICOLA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN PRODUCCION ANIMAL'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN PRODUCCION MADERERA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN PRODUCCION PECUARIA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN FLORICULTURA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN FRUTICULTURA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN FLORI- FRUTICULTURA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN CUNICULTURA Y ESPECIES MENORES'],
            ['parent_id'=>7,'name'=>'TECNICO SUPERIOR EN MECANIZACION AGRICOLA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN MECANIZACION AGRICOLA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR FORESTAL'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN ACUICULTURA'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN NUTRICION ANIMAL'],
            ['parent_id'=>7,'name'=>'TECNOLOGO SUPERIOR EN CUIDADO CANINO'],
            ['parent_id'=>8,'name'=>'TECNICO SUPERIOR EN ODONTOLOGIA'],
            ['parent_id'=>8,'name'=>'TECNICO SUPERIOR EN MECANICA DENTAL'],
            ['parent_id'=>8,'name'=>'TECNICO SUPERIOR EN LABORATORIO CLINICO'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN LABORATORIO CLINICO'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN EMERGENCIAS MEDICAS'],
            ['parent_id'=>8,'name'=>'TECNICO SUPERIOR EN IMAGENOLOGIA'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN IMAGENOLOGIA'],
            ['parent_id'=>8,'name'=>'TECNICO SUPERIOR EN REHABILITACION FISICA'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN REHABILITACION FISICA'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN ENFERMERIA'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN FARMACIA'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN PODOLOGIA'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN NATUROPATIA'],
            ['parent_id'=>8,'name'=>'TECNICO SUPERIOR EN ATENCION PRIMARIA DE SALUD'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN ATENCION INTEGRAL A ADULTOS MAYORES'],
            ['parent_id'=>8,'name'=>'TECNOLOGO SUPERIOR EN DESARROLLO INFANTIL INTEGRAL'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN TRICOLOGIA Y COSMIATRIA'],
            ['parent_id'=>9,'name'=>'ASESOR DE IMAGEN CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN ESTETICA INTEGRAL'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN ESTETICA INTEGRAL'],
            ['parent_id'=>9,'name'=>'MAQUILLISTA PROFESIONAL CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN TANATOESTETICA'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN HOTELERIA'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN GASTRONOMIA'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN ARTE CULINARIO ECUATORIANO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN DIETETICA Y COCINA LIGHT'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN PANADERIA Y REPOSTERIA'],
            ['parent_id'=>9,'name'=>'GESTOR DE EVENTOS, FERIAS Y CONVENCIONES CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>9,'name'=>'ENTRENADOR DEPORTIVO CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>9,'name'=>'ENTRENADOR DEPORTIVO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>9,'name'=>'DIRECTOR TECNICO EN DEPORTES CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>9,'name'=>'DIRECTOR TECNICO EN DEPORTES CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN TURISMO'],
            ['parent_id'=>9,'name'=>'GUIA NACIONAL DE TURISMO CON NIVEL EQUIVALENTE A TECNICO SUPERIOR'],
            ['parent_id'=>9,'name'=>'GUIA NACIONAL DE TURISMO CON NIVEL EQUIVALENTE A TECNOLOGO SUPERIOR'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN PLANIFICACION Y DESARROLLO DE PROYECTOS TURISTICOS'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SERVICIOS AEREOS'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SALUBRIDAD Y MANEJO AMBIENTAL'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN SEGURIDAD INTEGRAL'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SEGURIDAD INTEGRAL'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN SEGURIDAD Y PREVENCION DE RIESGOS LABORALES'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SEGURIDAD Y PREVENCION DE RIESGOS LABORALES'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN SEGURIDAD E HIGIENE DEL TRABAJO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SEGURIDAD E HIGIENE DEL TRABAJO'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN INTERPRETACION DE LENGUA DE SEÑAS'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN OPERACIONES DE RESCATE'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN OPERACIONES DE RESCATE'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN CIENCIAS MILITARES'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN CIENCIAS MILITARES'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN SEGURIDAD CIUDADANA Y ORDEN PUBLICO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SEGURIDAD CIUDADANA Y ORDEN PUBLICO'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN INVESTIGACION DE ACCIDENTES DE TRANSITO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN INVESTIGACION DE ACCIDENTES DE TRANSITO'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN SEGURIDAD PENITENCIARIA'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SEGURIDAD PENITENCIARIA'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN CIENCIAS DE LA SEGURIDAD'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN CIENCIAS DE LA SEGURIDAD'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN SEGURIDAD ELECTRONICA'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN SEGURIDAD ELECTRONICA'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN PLANIFICACION Y GESTION DEL TRANSITO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN PLANIFICACION Y GESTION DEL TRANSITO'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN VIGILANCIA Y SEGURIDAD CIUDADANA'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN VIGILANCIA Y SEGURIDAD CIUDADANA'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN INVESTIGACIONES DE POLICIA JUDICIAL'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN INVESTIGACIONES DE POLICIA JUDICIAL'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN LOGISTICA Y TRANSPORTE'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN LOGISTICA Y TRANSPORTE'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN LOGISTICA MULTIMODAL'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN LOGISTICA MULTIMODAL'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN LOGISTICA PORTUARIA'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN TRAFICO AEREO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN TRAFICO AEREO'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN PLANIFICACION Y GESTION DEL TRANSPORTE TERRESTRE'],
            ['parent_id'=>9,'name'=>'TECNICO SUPERIOR EN LOGISTICA DE ALMACENAMIENTO Y DISTRIBUCION'],
            ['parent_id'=>9,'name'=>'TECNOLOGO SUPERIOR EN LOGISTICA DE ALMACENAMIENTO Y DISTRIBUCION'],
        )->create();
    }

    private function createProfessionals()
    {
        Professional::factory()->create(['user_id' => 1]);
//        Professional::factory(10)->create();
    }

    private function createAcademicFormations()
    {
        AcademicFormation::factory(10)->create();
    }

    private function createExperiences()
    {
        Experience::factory(10)->create();
    }

    private function createCompanies()
    {
        Company::factory(10)->create();
    }

    private function createCourses()
    {
        Course::factory(10)->create();
    }

    private function createLanguages()
    {
        Language::factory(10)->create();
    }

    private function createReferences()
    {
        Reference::factory(10)->create();
    }

    private function createSkills()
    {
        Skill::factory(10)->create();
    }

    private function createOffers()
    {
        Offer::factory(10)->create();
    }

    private function createCategoryOffers()
    {
        Offer::factory()
            ->count(10)
            ->hasCategories(5)
            ->create();
    }

    private function createCompanyProfessionals()
    {
        Professional::factory(5)
            ->has(Company::factory()->count(3))
            ->create();
    }

    private function createOfferProfessionals()
    {
        Professional::factory(5)
            ->has(Offer::factory()->count(3))
            ->create();
    }
}
