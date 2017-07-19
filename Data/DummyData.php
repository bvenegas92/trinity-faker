<?php
namespace Trinity\Faker\Data;

class DummyData
{
    /**
     * Lista de carreras
     * @var array
     */
    public static $carreras = array(
        'TPF' => 'Licenciatura en Terapia Física',
        'AGP' => 'Licenciatura en Administración y Gestión de PyMES',
        'BIO' => 'Ingeniería en Biotecnología',
        'INF' => 'Ingeniería en Informática',
        'MEC' => 'Ingeniería Mecatrónica',
        'ENE' => 'Ingeniería en Energía',
        'LYT' => 'Ingeniería en Logistíca y Transporte',
        'AMB' => 'Ingeniería en Tecnología Ambiental',
        'BMD' => 'Ingeniería Biomédica',
        'AEF' => 'Ingeniería en Animación y Efectos Visuales'
    );

    /**
     * Lista de asignaturas de cada carrera en cada cuatrimestre
     * @var array
     */
    public static $asignaturas = array(
        'TPF' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "FUNDAMENTOS DE FÍSICA",
                "BIOLOGÍA CELULAR Y MOLECULAR",
                "SISTEMA MUSCULOESQUELÉTICO",
                "ATENCIÓN PREHOSPITALARIA",
                "INTRODUCCIÓN A LA TERAPIA FÍSICA"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "METODOLOGÍA DE LA INVESTIGACIÓN",
                "FUNDAMENTOS DE BIOQUÍMICA",
                "ANATOMÍA CARDIOPULMONAR",
                "MÉTODOS EN TERAPIA FÍSICA",
                "AGENTES FÍSICOS TERAPÉUTICOS"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "PROBABILIDAD Y ESTADÍSTICA",
                "FISIOLOGÍA HUMANA",
                "SISTEMAS CORPORALES",
                "TÉCNICAS EN TERAPIA FÍSICA",
                "KINESIOLOGÍA"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "CLÍNICA PROPEDÉUTICA EN TERAPIA FÍSICA",
                "NEUROFISIOLOGÍA",
                "NEUROANATOMÍA",
                "EJERCICIOS FUNCIONALES TERAPÉUTICOS",
                "CULTURA FÍSICA TERAPÉUTICA"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "LESIONADO MEDULAR",
                "NEUROPATOLOGÍA HUMANA",
                "RADIOLOGÍA E IMAGEN",
                "LEGISLACIÓN Y NORMATIVA EN EL SECTOR SALUD",
                "BIOMECÁNICA DEL APARATO LOCOMOTOR"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "HIDROTERAPIA",
                "REHABILITACIÓN NEUROLÓGICA",
                "NEUROFACILITACIÓN",
                "APRENDIZAJE Y DESARROLLO MOTOR",
                "TERAPIA OCUPACIONAL Y DE LENGUAJE"
            ),
            array(
                "INGLÉS VII",
                "TERAPIA FÍSICA EN EL DÉBIL VISUAL",
                "FISIOLOGÍA DEL EJERCICIO",
                "ELECTROTERAPIA",
                "PSICOLOGÍA EN TERAPIA FÍSICA",
                "TECNOLOGÍAS ASISTENCIALES",
                "ADMINISTRACIÓN HOSPITALARIA"
            ),
            array(
                "INGLÉS VIII",
                "TERAPIA FÍSICA EN OBSTETRICIA",
                "TERAPIA FÍSICA EN EL ADULTO MAYOR",
                "TERAPIA FÍSICA CARDIORESPIRATORIA",
                "TERAPIA FÍSICA EN TRAUMATOLOGÍA Y ORTOPEDIA",
                "TERAPIA FÍSICA EN EL AMPUTADO",
                "ORTESIS Y PRÓTESIS"
            ),
            array(
                "INGLÉS IX",
                "TERAPIA FÍSICA EN QUEMADOS",
                "ESTANCIA I",
                "ESTANCIA II"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'AGP' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "INTRODUCCIÓN A LAS MATEMÁTICAS",
                "INTRODUCCIÓN A LA ADMINISTRACIÓN",
                "FUNDAMENTOS DE CONTABILIDAD",
                "HERRAMIENTAS DE OFIMÁTICA",
                "EXPRESIÓN ORAL Y ESCRITA"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "MATEMÁTICAS APLICADAS A LA ADMINISTRACIÓN",
                "PROCESO ADMINISTRATIVO",
                "CONTABILIDAD FINANCIERA",
                "ASPECTOS LEGALES DE LA ORGANIZACIÓN",
                "ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "PROBABILIDAD Y ESTADÍSTICA",
                "PLANEACIÓN ESTRATÉGICA",
                "CONTABILIDAD DE COSTOS",
                "MICROECONOMÍA",
                "METODOLOGÍA DE LA INVESTIGACIÓN"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "MACROECONOMÍA",
                "ADMINISTRACIÓN DEL CAPITAL HUMANO",
                "CONTABILIDAD ADMINISTRATIVA",
                "FUNDAMENTOS DE MERCADOTECNIA",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "MATEMÁTICAS FINANCIERAS",
                "COMPORTAMIENTO Y DESARROLLO ORGANIZACIONAL",
                "NEGOCIACIÓN EMPRESARIAL",
                "INVESTIGACIÓN DE MERCADOS",
                "DERECHO LABORAL"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "MÉTODOS CUANTITATIVOS Y PRONÓSTICOS",
                "ADMINISTRACIÓN DE SUELDOS Y SALARIOS",
                "ANÁLISIS FINANCIERO",
                "MERCADOTECNIA ESTRATÉGICA",
                "TECNOLOGÍAS DE INFORMACIÓN APLICADA A LOS NEGOCIOS"
            ),
            array(
                "INGLÉS VII",
                "ADMINISTRACIÓN DE LA PRODUCCIÓN",
                "COMERCIO INTERNACIONAL",
                "AUDITORÍA ADMINISTRATIVA",
                "ADMINISTRACIÓN FINANCIERA",
                "COMERCIO ELECTRÓNICO",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "CALIDAD",
                "CONTRIBUCIONES FISCALES",
                "SEMINARIO DE HABILIDADES GERENCIALES",
                "FORMULACIÓN Y EVALUACIÓN DE PROYECTOS DE INVERSIÓN",
                "DESARROLLO EMPRENDEDOR",
                "LOGÍSTICA ADMINISTRATIVA"
            ),
            array(
                "INGLÉS IX",
                "DESARROLLO SUSTENTABLE",
                "CONSULTORÍA",
                "HERRAMIENTAS METODOLÓGICAS PARA LA CALIDAD",
                "DESARROLLO DE LA GESTIÓN ADMINISTRATIVA EN LAS ORGANIZACIONES",
                "ADMINISTRACIÓN DE EMPRESAS AGROINDUSTRIALES",
                "GESTIÓN DE LA INNOVACIÓN"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'BIO' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "ÁLGEBRA LINEAL",
                "QUÍMICA INORGÁNICA",
                "PROBABILIDAD Y ESTADÍSTICA",
                "OFIMÁTICA",
                "FÍSICA"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "CÁLCULO DIFERENCIAL E INTEGRAL",
                "QUÍMICA ANALÍTICA",
                "QUÍMICA ORGÁNICA",
                "METODOLOGÍA DE LA INVESTIGACIÓN",
                "TERMODINÁMICA"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "CALIDAD DEL PRODUCTO BIOTECNOLÓGICO",
                "ANÁLISIS QUÍMICO CUANTITATIVO",
                "BIOLOGÍA CELULAR Y MOLECULAR",
                "ANÁLISIS INSTRUMENTAL",
                "EQUILIBRIO QUÍMICO"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "MICROBIOLOGÍA GENERAL",
                "ANÁLISIS DIFERENCIAL",
                "BIOQUÍMICA MICROBIANA",
                "BALANCE DE MATERIA Y ENERGÍA",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "MICROBIOLOGÍA APLICADA",
                "MÉTODOS NUMÉRICOS",
                "GENÉTICA MOLECULAR",
                "FENÓMENOS DE TRANSPORTE DE MOMENTO Y CALOR",
                "DISEÑO DE EXPERIMENTOS"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "OPERACIONES UNITARIAS",
                "PLANEACIÓN E IMPLEMENTACIÓN DE LA PRODUCCIÓN",
                "INGENIERÍA GENÉTICA",
                "FENÓMENOS DE TRANSPORTE DE MASA",
                "INGENIERÍA DE BIOPROCESOS"
            ),
            array(
                "INGLÉS VII",
                "CONTROL ESTADÍSTICO DEL PROCESO",
                "VERIFICACIÓN Y CONTROL DE LA PRODUCCIÓN",
                "INGENIERÍA DE BIORREACTORES",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "BIOTECNOLOGÍA MÉDICA",
                "BIOTECNOLOGÍA VEGETAL",
                "ENZIMOLOGÍA",
                "PROCESOS DE BIOSEPARACIÓN",
                "INGENIERÍA DE PROYECTOS"
            ),
            array(
                "INGLÉS IX",
                "BIOTECNOLOGÍA ALIMENTARIA",
                "BIOTECNOLOGÍA AMBIENTAL",
                "BIOTECNOLOGÍA MARINA",
                "GESTIÓN DE CALIDAD",
                "CONTROL PARA BIOPROCESOS",
                "EVALUACIÓN ECONÓMICA DE PROYECTOS"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'INF' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "MATEMÁTICAS",
                "FUNDAMENTOS DE FÍSICA",
                "LÓGICA DE PROGRAMACIÓN",
                "INGENIERÍA DE HARDWARE"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "CÁLCULO DIFERENCIAL E INTEGRAL",
                "ADMINISTRACIÓN Y CONTABILIDAD",
                "FUNDAMENTOS DE PROGRAMACIÓN ESTRUCTURADA",
                "MANTENIMIENTO DE EQUIPO DE COMPUTO"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "PROBABILIDAD Y ESTADÍSTICA",
                "ANÁLISIS DE SISTEMAS",
                "PROGRAMACIÓN ESTRUCTURADA",
                "MATEMÁTICAS DISCRETAS",
                "ESTRUCTURA DE DATOS"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "MÉTODOS NUMÉRICOS",
                "DISEÑO DE SISTEMAS",
                "FUNDAMENTOS DE PROGRAMACIÓN ORIENTADA A OBJETOS",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "FUNDAMENTOS DE REDES DE COMPUTADORAS",
                "INGENIERÍA DE SOFTWARE",
                "PROGRAMACIÓN ORIENTADA A OBJETOS",
                "BASE DE DATOS"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "DISEÑO DE REDES DE COMPUTADORAS",
                "NGENIERÍA DE SOFTWARE APLICADA",
                "SISTEMAS OPERATIVOS",
                "BASE DE DATOS DISTRIBUIDAS"
            ),
            array(
                "INGLÉS VII",
                "CONFIGURACION DE REDES DE COMPUTADORAS",
                "GESTION DE PROYECTOS DE TECNOLÓGIA",
                "HERRAMIENTAS WEB",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "INVESTIGACION DE OPERACIONES",
                "ADMINISTRACION DE REDES DE COMPUTADORAS",
                "PROGRAMACION AVANZADA",
                "PROGRAMACION EN INTERNET",
                "VISION EMPRESARIAL"
            ),
            array(
                "INGLÉS IX",
                "INTERACCION HUMANO COMPUTADORA",
                "ADMINISTRACIÓN DE LA FUNCIÓN INFORMÁTICA",
                "INVESTIGACION APLICADA",
                "SISTEMAS INTEGRALES DE INFORMACIÓN"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'MEC' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "METROLOGÍA",
                "ELECTRICIDAD Y MAGNETISMO",
                "DIBUJO PARA INGENIERÍA",
                "CÁLCULO DIFERENCIAL E INTEGRAL",
                "ÁLGEBRA LINEAL"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "ESTÁTICA",
                "ANÁLISIS DE CIRCUITOS ELÉCTRICOS",
                "PROGRAMACIÓN ESTRUCTURADA",
                "CÁLCULO VECTORIAL",
                "NORMATIVIDAD Y SEGURIDAD INDUSTRIAL"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "DINÁMICA",
                "ELECTRÓNICA ANALÓGICA",
                "ELECTRÓNICA DIGITAL",
                "PROBABILIDAD Y ESTADÍSTICA",
                "INGENIERÍA DEL MANTENIMIENTO"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "RESISTENCIA DE MATERIALES",
                "ELECTRÓNICA DE POTENCIA",
                "PROGRAMACIÓN DE PERIFÉRICOS",
                "ECUACIONES DIFERENCIALES",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "ANÁLISIS DE MECANISMOS",
                "SENSORES Y ACONDICIONAMIENTO DE SEÑALES",
                "MICROCONTROLADORES",
                "MODELADO Y SIMULACIÓN DE SISTEMAS",
                "MECÁNICA DE FLUIDOS"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "DISEÑO MECÁNICO",
                "AUTOMATIZACIÓN INDUSTRIAL",
                "MÁQUINAS ELÉCTRICAS",
                "PROCESOS DE MANUFACTURA",
                "SISTEMAS HIDRÁULICOS Y NEUMÁTICOS"
            ),
            array(
                "INGLÉS VII",
                "ADQUISICIÓN Y PROCESAMIENTO DE SEÑALES",
                "INGENIERÍA ASISTIDA POR COMPUTADORA",
                "ADMINISTRACIÓN E INGENIERÍA DE PROYECTOS",
                "INGENIERÍA ECONÓMICA",
                "TEORÍA DE CONTROL",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "TERMODINÁMICA",
                "SISTEMAS CAM Y CNC",
                "DISEÑO MECATRÓNICO",
                "CINEMÁTICA DE ROBOTS",
                "CONTROL DIGITAL",
                "VIBRACIONES MECÁNICAS"
            ),
            array(
                "INGLÉS IX",
                "TRANSFERENCIA DE CALOR",
                "REDES INDUSTRIALES",
                "INTEGRACIÓN DE SISTEMAS MECATRÓNICOS",
                "DINÁMICA Y CONTROL DE ROBOTS",
                "CONTROL INTELIGENTE",
                "CALIDAD E INNOVACIÓN TECNOLÓGICA"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'ENE' => array(
            array(
                "INTRODUCCIÓN A LA INGENIERÍA EN ENERGÍA",
                "TRANSFORMACIONES QUÍMICAS CON LABORATORIO",
                "MECÁNICA CON LABORATORIO",
                "CÁLCULO DIFERENCIAL",
                "INGLÉS I",
                "PROGRAMACIÓN",
                "VALORES DEL SER"
            ),
            array(
                "SEMINARIO DE INGENIERÍA EN ENERGÍA TÉRMICA",
                "TERMODINÁMICA CON LABORATORIO",
                "LABORATORIO DE SIMULACIÓN Y DISEÑO POR COMPUTADORA",
                "CÁLCULO INTEGRAL",
                "INGLÉS II",
                "ÓPTICA",
                "INTELIGENCIA EMOCIONAL"
            ),
            array(
                "SEMINARIO DE INGENIERÍA EN ENERGÍA EÓLICA",
                "TRANSFERENCIA DE CALOR Y MASA",
                "CÁLCULO DE VARIAS VARIABLES",
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "MECÁNICA DE FLUIDOS CON LABORATORIO",
                "ÁLGEBRA LINEAL"
            ),
            array(
                "SEMINARIO DE INGENIERÍA EN ENERGÍA DEL HIDRÓGENO",
                "ENERGÍA DEL HIDRÓGENO CON LABORATORIO",
                "ECUACIONES DIFERENCIALES",
                "FÍSICA MODERNA",
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "ESTANCIA I"
            ),
            array(
                "SEMINARIO DE INGENIERÍA EN ENERGÍA FOTOVOLTAICA",
                "ESTADO SÓLIDO",
                "ELECTRICIDAD Y MAGNETISMO CON LABORATORIO",
                "ECUACIONES DIFERENCIALES PARCIALES",
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "SISTEMAS FOTOVOLTAICOS CON LABORATORIO"
            ),
            array(
                "SEMINARIO DE INGENIERÍA EN ENERGÍA DE BIOMASA",
                "ELECTROQUÍMICA",
                "MÁQUINAS ELÉCTRICAS",
                "BIOMASA CON LABORATORIO",
                "CELDAS DE COMBUSTIBLE",
                "INGLÉS VI",
                "ÉTICA PROFESIONAL"
            ),
            array(
                "METROLOGÍA E INSTRUMENTACIÓN",
                "FÍSICA NUCLEAR CON LABORATORIO",
                "INGENIERÍA AMBIENTAL",
                "TECNOLOGÍA DE LOS GENERADORES ELECTROMECÁNICOS",
                "INGLÉS VII",
                "CONTABILIDAD EMPRESARIAL",
                "ESTANCIA II"
            ),
            array(
                "ALMACENAMIENTO DE LA ENERGÍA SOLAR",
                "AHORRO Y USO EFICIENTE DE ENERGÍA",
                "SEGURIDAD INDUSTRIAL",
                "ENERGÍA HIDRÁULICA CON LABORATORIO",
                "INGENIERÍA ENERGÉTICA",
                "DISEÑO SUSTENTABLE DE INSTALACIONES ELÉCTRICAS",
                "INGLÉS VIII"
            ),
            array(
                "INNOVACIÓN TECNOLÓGICA",
                "INTRODUCCIÓN A LA ADMINISTRACIÓN",
                "INTRODUCCIÓN A LA ARQUITECTURA BIOCLIMÁTICA",
                "GESTIÓN DE PROYECTOS",
                "INGLÉS IX",
                "DISEÑO SUSTENTABLE CON ENERGÍAS ALTERNATIVAS",
                "ÉTICA DE LOS NEGOCIOS"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'LYT' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "FUNDAMENTOS DE LA CADENA DE SUMINISTRO",
                "ADMINISTRACIÓN Y PRINCIPIOS DE ECONOMÍA",
                "TEMAS SELECTOS DE FÍSICA",
                "CALIDAD EN LA CADENA DE SUMINISTRO",
                "PROBABILIDAD Y ESTADÍSTICA"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "LOGÍSTICA DEL ABASTECIMIENTO",
                "CÁLCULO DIFERENCIAL E INTEGRAL",
                "QUÍMICA ENERGÉTICA Y AMBIENTAL",
                "CONTROL ESTADÍSTICO DE LA CALIDAD",
                "LÓGICA DE PROGRAMACIÓN"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "PRONÓSTICOS EN LA CADENA DE SUMINISTROS",
                "PLANEACIÓN Y CONTROL DE INVENTARIOS",
                "ALGEBRA LINEAL",
                "INTRODUCCIÓN A LA OPERACIÓN DEL TRANSPORTE",
                "TI APLICADAS A LA LOGÍSTICA"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "LOGÍSTICA DE LA PRODUCCIÓN",
                "INVESTIGACIÓN DE OPERACIONES LOGÍSTICAS",
                "SISTEMAS DE TRANSPORTACIÓN FERROVIARIO Y CARRETERO",
                "TI APLICADAS AL TRANSPORTE",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "CENTROS DE DISTRIBUCIÓN Y ALMACENES",
                "MÉTODOS CUANTITATIVOS PARA OPTIMIZACIÓN",
                "SISTEMAS DE TRANSPORTACIÓN AÉREO Y MARÍTIMO",
                "TÉCNICAS DE SELECCIÓN Y RENOVACIÓN VEHICULAR",
                "MERCADOTECNIA Y VENTA DEL SERVICIO"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "PLANEACIÓN ESTRATÉGICA",
                "ECONOMÍA DEL TRANSPORTE",
                "ADMINISTRACIÓN DEL MANTENIMIENTO",
                "TRANSPORTE Y SISTEMA DE DISTRIBUCIÓN",
                "ADMINISTRACIÓN DE PERSONAL"
            ),
            array(
                "INGLÉS VII",
                "BLOQUES ECONÓMICOS",
                "SISTEMAS DE COSTEO EN OPERACIONES LOGÍSTICAS",
                "ESTUDIOS DE INGENIERÍA DEL TRANSPORTE",
                "PLANEACIÓN OPERATIVA EN LA LOGÍSTICA Y EL TRANSPORTE",
                "METODOLOGÍA DE LA INVESTIGACIÓN",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "LOGÍSTICA EN EL COMERCIO INTERNACIONAL",
                "OPERACIÓN DE FLOTAS Y TERMINALES",
                "INGENIERÍA ECONÓMICA",
                "LEGISLACIÓN Y DERECHO DEL TRANSPORTE",
                "INGENIERÍA DE TRÁNSITO",
                "OPERACIÓN DE ALMACENES Y REFACCIONARIAS"
            ),
            array(
                "INGLÉS IX",
                "DISTRIBUCIÓN FÍSICA INTERNACIONAL",
                "GESTIÓN Y DIRECCIÓN DE EMPRESAS",
                "FORMULACIÓN Y EVALUACIÓN DE PROYECTOS",
                "MODELOS DE TRANSPORTE Y LOGÍSTICA",
                "TRANSPORTE URBANO",
                "SEMINARIO DE ANÁLISIS DE CASOS Y DECISIONES"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'AMB' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "QUÍMICA INORGÁNICA",
                "FÍSICA",
                "ECUACIONES LINEALES",
                "OFIMÁTICA",
                "BIOLOGÍA"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "QUÍMICA ORGÁNICA",
                "QUÍMICA ANALÍTICA",
                "CÁLCULO DIFERENCIAL E INTEGRAL",
                "BIOESTADÍSTICA",
                "ECOLOGÍA DE SISTEMAS AMBIENTALES"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "QUÍMICA AMBIENTAL",
                "MICROBIOLOGÍA AMBIENTAL",
                "MODELOS MATEMÁTICOS",
                "MUESTREO ESTADÍSTICO",
                "CONTAMINACIÓN AMBIENTAL"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "DISEÑO EXPERIMENTAL",
                "BIOQUÍMICA",
                "TERMODINÁMICA",
                "GESTIÓN INTEGRAL DE RESIDUOS",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "BALANCE DE MATERIA Y ENERGÍA",
                "FISICOQUÍMICA",
                "DESARROLLO SUSTENTABLE",
                "LEGISLACIÓN AMBIENTAL Y GESTIÓN",
                "IMPACTO AMBIENTAL "
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "FENÓMENOS DE TRANSPORTE",
                "ORDENAMIENTO TERRITORIAL Y ECOLÓGICO",
                "PLANEACIÓN ESTRATÉGICA Y CONSULTORÍA",
                "ANÁLISIS DE RIESGO LABORAL Y AMBIENTAL",
                "AUDITORÍA AMBIENTAL"
            ),
            array(
                "INGLÉS VII",
                "OPERACIONES UNITARIAS PARA SISTEMAS AMBIENTALES",
                "MECÁNICA DE FLUIDOS E HIDRÁULICA",
                "TOXICOLOGÍA AMBIENTAL",
                "MÉTODOS NUMÉRICOS",
                "INGENIERÍA ECONÓMICA",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "INGENIERÍA DE BIOPROCESOS",
                "FORMULACIÓN Y EVALUACIÓN DE PROYECTOS DE INVERSIÓN",
                "REMEDIACIÓN DE SUELOS",
                "TECNOLOGÍA PARA EL TRATAMIENTO DE AGUAS",
                "ENERGÍAS ALTERNATIVAS",
                "SISTEMAS DE CONSERVACIÓN AMBIENTALES"
            ),
            array(
                "INGLÉS IX",
                "DISEÑO DE TECNOLOGÍAS AMBIENTALES",
                "SIMULACIÓN Y EVALUACIÓN DE TECNOLOGÍAS AMBIENTALES",
                "TECNOLOGÍA PARA EL TRATAMIENTO DE AIRE",
                "OPERACIONES UNITARIAS AVANZADAS",
                "TECNOLOGÍA ENZIMÁTICA",
                "TRATAMIENTO DE RESIDUOS"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'BMD' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "INTRODUCCION A LA INGENIERÍA BIOMÉDICA",
                "CALCULO DIFERENCIAL",
                "HERRAMIENTAS OFIMÁTICAS",
                "FUNDAMENTOS DE FÍSICA",
                "FUNDAMENTOS DE QUÍMICA"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "INSTRUMENTACION BIOMÉDICA",
                "CÁLCULO INTEGRAL",
                "MEDICIONES ELÉCTRICAS",
                "FUNDAMENTOS DE ELECTRONICA",
                "BIOQUÍMICA CLÍNICA"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "MÉTODOS NUMERICOS",
                "APLICACION DE ECUACIONES DIFERENCIALES",
                "ALGEBRA LINEAL",
                "PROGRAMACION ESTRUCTURADA",
                "ELECTRÓNICA ANALÓGICA"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "PROBABILIDAD Y ESTADISTICA",
                "BASE DE DATOS",
                "PROGRAMACION ORIENTADA A OBJETOS",
                "ELECTRONICA DIGITAL",
                "ESTANCIA I"
            ),
            array(
                "INGLÉS V",
                "HABILIDADES ORGANIZACIONALES",
                "SENSORES Y ACTUADORES BIOMÉDICOS",
                "FISIOLOGIA",
                "ENTORNO DE INSTRUMENTACION",
                "MAQUINAS ELECTRICAS",
                "ELECTRONICA DE POTENCIA"
            ),
            array(
                "INGLÉS VI",
                "ETICA PROFESIONAL",
                "SUMINISTRO DE ENERGIA ELECTRICA",
                "SISTEMA DE GESTION DE SALUD",
                "MANTENIMIENTO DE EQUIPO MEDICO",
                "MICROPROCESADORES",
                "FÍSICA MEDICA"
            ),
            array(
                "INGLÉS VII",
                "DISEñO ASISTIDO POR COMPUTADORA",
                "APLICACIONES DE LA TELEMEDICINA",
                "SERIES Y TRANSFORMADAS",
                "PROTOCOLOS E INTERFACES D COMUNICACION",
                "TECNOLOGÍA CLÍNICA HOSPITALARIA",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "SISTEMAS DE CONTROL",
                "DESARROLLO DE SISTEMAS BIOMEDICOS",
                "TECNOLOGÍA HOSPITALARIA AMBIENTAL",
                "SEGURIDAD Y NORMAS",
                "PROCESAMIENTO DE SEÑAS BIOMÉDICAS",
                "DISPOSITIVOS PROGRAMABLES"
            ),
            array(
                "INGLÉS IX",
                "INGENIERÍA ECONÓMICA",
                "INTEGRACION DE SISTEMAS BIOMÉDICOS",
                "PROCESAMIENTO DE IMÁGENES",
                "FUNDAMENTOS DE TELEMEDICINA",
                "ADMINISTRACION DE RECURSOS HOSPITALARIOS",
                "BIOMECÁNICA"
            ),
            array(
                "ESTADÍA"
            )
        ),
        'AEF' => array(
            array(
                "INGLÉS I",
                "VALORES DEL SER",
                "TALLER DE MODELADO",
                "HERRAMIENTAS OFIMÁTICAS",
                "DIBUJO ARTÍSTICO",
                "ANATOMÍA HUMANA Y ANIMAL",
                "ALGEBRA LINEAL"
            ),
            array(
                "INGLÉS II",
                "INTELIGENCIA EMOCIONAL",
                "HISTORIA Y ANÁLISIS DEL ARTE",
                "TEORÍA DEL COLOR APLICADA A LA PINTURA",
                "DIBUJO DIGITAL",
                "CÁLCULO",
                "FUNDAMENTOS DE FÍSICA"
            ),
            array(
                "INGLÉS III",
                "DESARROLLO INTERPERSONAL",
                "ANIMACIÓN 2D",
                "CREACIÓN Y PSICOLOGÍA DE PERSONAJES",
                "INTRODUCCIÓN AL MODELADO 3D",
                "PROBABILIDAD Y ESTADÍSTICA",
                "ANÁLISIS DE HISTORIAS"
            ),
            array(
                "INGLÉS IV",
                "HABILIDADES DEL PENSAMIENTO",
                "NARRATIVA",
                "CARACTERIZACIÓN DE PERSONAJES EN 3D",
                "SEMIÓTICA",
                "FUNDAMENTOS DE FOTOGRAFÍA",
                "ESTANCIA I"
            ),
            array(
                "INGLES V",
                "HABILIDADES ORGANIZACIONALES",
                "STORYBOARD",
                "LOGICA PARA PROGRAMACIÓN",
                "INTRODUCCIÓN A LA ANIMACIÓN 3D",
                "EDICIÓN Y COMPOSICIÓN FOTOGRÁFICA",
                "GRABACIÓN DE AUDIO"
            ),
            array(
                "INGLÉS VI",
                "ÉTICA PROFESIONAL",
                "PAINTING 3D",
                "DISEÑO DE ALGORITMOS",
                "ESQUELETOS Y CINEMÁTICA",
                "DISEÑO DE ESCENARIOS EN MAQUETA",
                "DISEÑO DE AUDIO"
            ),
            array(
                "INGLÉS VII",
                "GESTIÓN DE PROYECTOS",
                "FUNDAMENTOS DE EFECTOS VISUALES",
                "DINÁMICOS Y FLUIDOS",
                "TÉCNICAS DE CINE",
                "DINÁMICOS Y ROPA",
                "ESTANCIA II"
            ),
            array(
                "INGLÉS VIII",
                "EMPRENDEDOR",
                "PRODUCCIÓN DE EFECTOS ESPECIALES",
                "DINÁMICOS Y MÚSCULOS",
                "DIRECCIÓN ARTÍSTICA",
                "SIMULACIÓN 3D",
                "CINEMATOGRAFÍA"
            ),
            array(
                "INGLÉS IX",
                "INVESTIGACIÓN DE MERCADOS",
                "COMPOSICIÓN DE EFECTOS",
                "DINÁMICOS Y PELO",
                "PROGRAMACIÓN",
                "PROPIEDAD INTELECTUAL",
                "MOTORES DE VIDEO JUEGOS"
            ),
            array(
                "ESTADÍA"
            )
        )
    );

    /**
     * Lista de nombres de hombre y mujer
     * @var array
     */
    public static $nombres = array(
        "H" => array(
            "Andres",
            "Aaron",
            "Abraham",
            "Adolfo",
            "Adrián",
            "Agustín",
            "Alberto",
            "Alejandro",
            "Alfonso",
            "Antonio",
            "Augusto",
            "Benjamín",
            "Benito",
            "Bruno",
            "Carlos",
            "Cristian",
            "Cruz",
            "César",
            "Daniel",
            "David",
            "Demetrio",
            "Dionisio",
            "Domingo",
            "Eduardo",
            "Efraín",
            "Enrique",
            "Eric",
            "Ernesto",
            "Esteban",
            "Ezequiel",
            "Fabián",
            "Federico",
            "Felipe",
            "Faustino",
            "Fernando",
            "Fermín",
            "Fidel",
            "Francisco",
            "Félix",
            "Gabriel",
            "Gerardo",
            "Gilberto",
            "Gregorio",
            "Guillermo",
            "Gustavo",
            "Genaro",
            "Horacio",
            "Héctor",
            "Hugo",
            "Humberto",
            "Ignacio",
            "Ivan",
            "Israel",
            "Julio",
            "Julián",
            "Javier",
            "Jesús",
            "Jorge",
            "José",
            "Juan",
            "Kevin",
            "Leonardo",
            "Leonel",
            "Luis",
            "Manuel",
            "Marcos",
            "Mario",
            "Miguel",
            "Martín",
            "Mauricio",
            "Noé",
            "Octavio",
            "Oscar",
            "Omar",
            "Osvaldo",
            "Orlando",
            "Pablo",
            "Patricio",
            "Paul",
            "Pedro",
            "Rafael",
            "Ramiro",
            "Raúl",
            "Ricardo",
            "Roberto",
            "René",
            "Rodolfo",
            "Rubén",
            "Salvador",
            "Sergio",
            "Sebastian",
            "Santiago",
            "Samuel",
            "Saúl",
            "Ulises",
            "Vicente",
            "Víctor"
        ),
        "M" => array(
            "Adriana",
            "Abigaíl",
            "Alba",
            "Aida",
            "Angélica",
            "Alejandra",
            "Araceli",
            "Aurora",
            "Ana",
            "Alicia",
            "Beatriz",
            "Berenice",
            "Blanca",
            "Brenda",
            "Camila",
            "Carla",
            "Carmen",
            "Cecilia",
            "Carolina",
            "Claudia",
            "Cinthia",
            "Consuelo",
            "Dana",
            "Diana",
            "Daniela",
            "Esperanza",
            "Erica",
            "Elena",
            "Elizabeth",
            "Elisa",
            "Fabiola",
            "Flor",
            "Fernanda",
            "Gloria",
            "Gabriela",
            "Graciela",
            "Hortensia",
            "Hilda",
            "Inés",
            "Irene",
            "Irma",
            "Isabel",
            "Ivonne",
            "Jazmín",
            "Julia",
            "Jennifer",
            "Jessica",
            "Karen",
            "Katia",
            "Karla",
            "Karina",
            "Laura",
            "Leticia",
            "Lidia",
            "Liliana",
            "Lucía",
            "Linda",
            "Luz",
            "Mayte",
            "Maria",
            "Mariana",
            "Martha",
            "Miriam",
            "Mónica",
            "Natalia",
            "Norma",
            "Nadia",
            "Olivia",
            "Olga",
            "Paloma",
            "Patricia",
            "Paula",
            "Perla",
            "Paola",
            "Raquel",
            "Rebeca",
            "Renata",
            "Rocío",
            "Rosa",
            "Rosario",
            "Sara",
            "Sandra",
            "Sonia",
            "Silvia",
            "Sofia",
            "Susana",
            "Tania",
            "Teresa",
            "Valentina",
            "Valeria",
            "Verónica",
            "Victoria",
            "Virginia",
            "Vanesa",
            "Wendy",
            "Ximena",
            "Yuridia",
            "Yolanda"
        )
    );

    /**
     * Lista de apellidos
     * @var array
     */
    public static $apellidos = array(
        "Acosta",
        "Acuña",
        "Aguilera",
        "Aguirre",
        "Alarcón",
        "Alvarado",
        "Álvarez",
        "Arce",
        "Arias",
        "Ávila",
        "Barrios",
        "Benítez",
        "Blanco",
        "Bravo",
        "Bustamante",
        "Cabrera",
        "Campos",
        "Cárdenas",
        "Cardozo",
        "Carrasco",
        "Carrizo",
        "Carvajal",
        "Castillo",
        "Castro",
        "Chávez",
        "Contreras",
        "Córdoba",
        "Cortés",
        "Díaz",
        "Domínguez",
        "Duarte",
        "Escobar",
        "Espinoza",
        "Fernández",
        "Figueroa",
        "Flores",
        "Franco",
        "Fuentes",
        "Gallardo",
        "García",
        "Gómez",
        "González",
        "Guerrero",
        "Gutiérrez",
        "Guzmán",
        "Hernández",
        "Herrera",
        "Jara",
        "Jiménez",
        "Juárez",
        "Lagos",
        "Ledesma",
        "Leiva",
        "López",
        "Luna",
        "Maldonado",
        "Mansilla",
        "Martinez",
        "Medina",
        "Méndez",
        "Mendoza",
        "Molina",
        "Montenegro",
        "Morales",
        "Moreno",
        "Muñoz",
        "Navarrete",
        "Navarro",
        "Núñez",
        "Ojeda",
        "Olivares",
        "Ortega",
        "Ortiz",
        "Páez",
        "Palma",
        "Paredes",
        "Parra",
        "Paz",
        "Peña",
        "Peralta",
        "Pereyra",
        "Pérez",
        "Pino",
        "Ponce",
        "Quiroga",
        "Ramírez",
        "Ramos",
        "Reyes",
        "Ríos",
        "Rivera",
        "Rodríguez",
        "Rojas",
        "Romero",
        "Ruiz",
        "Salazar",
        "Salinas",
        "Sánchez",
        "Sandoval",
        "Sepúlveda",
        "Silva",
        "Soto",
        "Suárez",
        "Tapia",
        "Toledo",
        "Torres",
        "Valdez",
        "Valenzuela",
        "Vargas",
        "Vázquez",
        "Vega",
        "Velázquez",
        "Venegas",
        "Vergara",
        "Vidal",
        "Yáñez",
        "Zúñiga"
    );

    /**
     * Lista de ciudades
     * @var array
     */
    public static $ciudades = array(
        array(
            'clave' => 'SL',
            'estado' => 'Sinaloa',
            'ciudad' => 'Mazatlán'
        ),
        array(
            'clave' => 'SL',
            'estado' => 'Sinaloa',
            'ciudad' => 'Culiacan'
        ),
        array(
            'clave' => 'SL',
            'estado' => 'Sinaloa',
            'ciudad' => 'Los Mochis'
        ),
        array(
            'clave' => 'JC',
            'estado' => 'Jalisco',
            'ciudad' => 'Guadalajara'
        ),
        array(
            'clave' => 'JC',
            'estado' => 'Jalisco',
            'ciudad' => 'Zapopan'
        ),
        array(
            'clave' => 'SR',
            'estado' => 'Sonora',
            'ciudad' => 'Ciudad Obregon'
        ),
        array(
            'clave' => 'SR',
            'estado' => 'Sonora',
            'ciudad' => 'Hermosillo'
        ),
        array(
            'clave' => 'NT',
            'estado' => 'Nayarit',
            'ciudad' => 'Tepic'
        )
    );
}
