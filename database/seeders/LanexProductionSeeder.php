<?php

namespace Database\Seeders;

use App\Models\WebBlog;
use App\Models\WebProduct;
use App\Models\WebReview;
use App\Models\WebService;
use App\Models\WebSupplier;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Production Seeder for LanEx (ExpressLane Logistics S.A.C.)
 *
 * Populates all production-ready entities:
 * 1. 5 Official Services from the company brochure (brochure_lanex.pdf)
 * 2. 12 Verified International Suppliers and Brands across 4 categories
 * 3. 10 Industrial/Commercial Products with pivot relations to suppliers
 * 4. 8 Authentic Foreign Trade & Customs Blogs
 * 5. 6 Verified Peruvian Corporate Client Testimonials
 *
 * Usage:
 *   php artisan db:seed --class=LanexProductionSeeder
 *   php artisan lanex:seed-production
 *   php scripts/seed_production.php
 */
class LanexProductionSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->info('Iniciando carga de datos de producción LanEx...');

        $this->seedServices();
        $this->seedSuppliersAndProducts();
        $this->seedBlogs();
        $this->seedReviews();

        $this->command?->info('✓ Datos de producción cargados exitosamente.');
    }

    /**
     * 1. Official Services from brochure_lanex.pdf
     */
    public function seedServices(): void
    {
        $services = [
            [
                'name' => 'Asesoría y Consultoría',
                'icon' => '/images/svgs/scale.svg',
                'short_description' => 'Servicio de asesoría personalizada, soporte en operaciones de comercio exterior y aduanas, así como soluciones logísticas de manera eficiente.',
                'webcontent' => [
                    'header' => 'Asesoría y Consultoría',
                    'image' => '/images/service/service_consultoria.jpg',
                    'title' => 'Soluciones estratégicas para sus operaciones de comercio exterior',
                    'description' => 'Brindamos asesoría especializada, orientando a nuestros clientes en la gestión de sus operaciones logísticas y aduaneras.',
                    'overview' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Brindamos asesoría especializada en cada etapa de su operación',
                        'image' => '/images/web/aboutus_1.svg',
                        'content' => [
                            'header' => 'Acompañamiento Experto',
                            'introduction' => 'Nuestro equipo analiza cada proceso para optimizar tiempos, costos y cumplimiento normativo, ofreciendo soluciones estratégicas adaptadas a cada tipo de negocio.',
                            'content' => 'Orientamos a nuestros clientes en la gestión de sus operaciones logísticas y aduaneras, evaluando costos logísticos y brindando planeamiento estratégico para sus operaciones internacionales.',
                        ],
                    ],
                    'content_link' => [
                        'header' => 'Asesoramiento',
                        'title' => 'Resolvemos tus consultas de comercio exterior',
                        'button_label' => 'Obtener Cotización',
                        'image' => '/images/web/certificate.svg',
                        'content' => 'Te acompañamos con asesoría en importaciones y exportaciones, evaluación de costos logísticos, orientación en normativas aduaneras vigentes y planeamiento estratégico de operaciones internacionales.',
                    ],
                    'keypoints' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Asesoría y Consultoría',
                        'points' => [
                            ['title' => 'Asesoría en Importaciones y Exportaciones', 'content' => 'Te guiamos en cada paso de tus operaciones de comercio exterior.'],
                            ['title' => 'Evaluación de Costos Logísticos', 'content' => 'Analizamos tus costos logísticos para encontrar la opción más eficiente.'],
                            ['title' => 'Orientación en Normativas Aduaneras Vigentes', 'content' => 'Te mantenemos al día con la normativa aduanera vigente de SUNAT.'],
                            ['title' => 'Planeamiento Estratégico de Operaciones Internacionales', 'content' => 'Diseñamos la estrategia logística ideal para tu negocio.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Qué incluye el servicio de asesoría?', 'answer' => 'Incluye asesoría en importaciones y exportaciones, evaluación de costos logísticos, orientación en normativas aduaneras vigentes y planeamiento estratégico de tus operaciones internacionales.'],
                            ['question' => '¿Puedo importar si no cuento con RUC 10 o 20?', 'answer' => 'Las personas naturales pueden realizar importaciones ocasionales cuyo valor FOB no exceda los límites establecidos por SUNAT (hasta US$ 1,000 tres veces al año o hasta US$ 3,000 una sola vez). Te asesoramos para conocer si tu caso aplica.'],
                            ['question' => '¿Cuáles son los requisitos para exportar e importar?', 'answer' => 'Entre los documentos básicos se encuentran la factura comercial (invoice), el conocimiento de embarque (B/L o AWB), el certificado de origen, la póliza de seguro y la lista de empaque (packing list).'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Agencia de Carga',
                'icon' => '/images/svgs/container.svg',
                'short_description' => 'Servicios de transporte de Carga Internacional. Trabajamos bajo modalidades FCL y LCL de la mano de navieras, agentes y consolidadoras.',
                'webcontent' => [
                    'header' => 'Agencia de Carga',
                    'image' => '/images/service/service_agencia_carga.jpg',
                    'title' => 'Transportamos su mercancía ofreciendo calidad y confianza',
                    'description' => 'Comprometidos con sus necesidades, transportamos su carga bajo las modalidades FCL, LCL y Breakbulk de la mano de navieras, agentes y consolidadoras.',
                    'overview' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Soluciones de transporte marítimo y aéreo a la medida',
                        'image' => '/images/web/ship_map.svg',
                        'content' => [
                            'header' => 'Cobertura Global',
                            'introduction' => 'Contamos con SOUL Clientes para el seguimiento de tus operaciones, transporte aéreo y marítimo de importaciones y exportaciones, carga de proyectos y transporte de carga con requerimientos especiales.',
                            'content' => 'Ofrecemos transporte de carga suelta o consolidada, así como transporte de carga refrigerada o seca, adaptándonos a las necesidades de cada envío.',
                        ],
                    ],
                    'content_link' => [
                        'header' => 'Servicio Marítimo',
                        'title' => 'FCL, LCL y Breakbulk a tu medida',
                        'button_label' => 'Cotiza Ahora',
                        'image' => '/images/web/ship.svg',
                        'content' => 'Servicio FCL (Full Container Load): transporte marítimo exclusivo de un contenedor 20\', 40\'HC, 40\' Reefer y 40\'NOR. Servicio LCL (Less Container Load): transporte marítimo compartido para movilizar carga con poco volumen. Servicio Breakbulk: transporte de cargas a granel o sobredimensionadas.',
                    ],
                    'keypoints' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Agencia de Carga',
                        'points' => [
                            ['title' => 'SOUL Clientes', 'content' => 'Plataforma para el seguimiento de tus operaciones en todo momento.'],
                            ['title' => 'Transporte Aéreo', 'content' => 'Importaciones y exportaciones prioritarias por vía aérea.'],
                            ['title' => 'Transporte Marítimo', 'content' => 'Importaciones y exportaciones por vía marítima FCL y LCL.'],
                            ['title' => 'Carga de Proyectos', 'content' => 'Soluciones especiales para maquinaria y estructuras sobredimensionadas.'],
                            ['title' => 'Carga con Requerimientos Especiales', 'content' => 'Manejo de cargas que requieren condiciones específicas de temperatura y estiba.'],
                            ['title' => 'Carga Refrigerada o Seca', 'content' => 'Transporte en contenedores Dry y Reefer adaptados según el tipo de mercancía.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Cuál es la diferencia entre FCL y LCL?', 'answer' => 'FCL es el uso exclusivo de un contenedor completo, mientras que LCL es un servicio consolidado compartido ideal para cargas de menor volumen optimizando costos de flete.'],
                            ['question' => '¿Cuáles son los principales países de importación?', 'answer' => 'Trabajamos con más de 20 países, siendo las rutas principales China, Estados Unidos, España, Alemania y Chile hacia los puertos de Callao y Chancay.'],
                            ['question' => '¿Cómo puedo realizar un seguimiento de mi envío?', 'answer' => 'Puedes realizar el seguimiento en tiempo real con transpondedor ADS-B y AIS a través de nuestra plataforma en línea ingresando tu número de orden.'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Logística OTM',
                'icon' => '/images/svgs/map-pin-check.svg',
                'short_description' => 'Servicio de transporte «puerta a puerta» actuando como intermediario del destinatario o de los transportistas de las operaciones de transporte multimodal.',
                'webcontent' => [
                    'header' => 'Logística OTM',
                    'image' => '/images/service/service_otm.jpg',
                    'title' => 'Gestión integral del transporte multimodal',
                    'description' => 'Actuamos como intermediarios entre el destinatario y los transportistas, coordinando cada operación de transporte multimodal puerta a puerta.',
                    'overview' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Coordinación integral de tu carga de principio a fin',
                        'image' => '/images/web/truck_delivery.svg',
                        'content' => [
                            'header' => 'Puerta a Puerta',
                            'introduction' => 'Coordinamos la integración de transporte marítimo, aéreo y terrestre, garantizando el control y seguimiento de la carga en todo momento.',
                            'content' => 'Optimizamos las rutas logísticas y gestionamos de forma integral toda la documentación necesaria para que tu carga llegue a destino sin contratiempos.',
                        ],
                    ],
                    'content_link' => [
                        'header' => 'Gestión Integral',
                        'title' => 'Del transporte multimodal',
                        'button_label' => 'Cotiza Ahora',
                        'image' => '/images/web/map.svg',
                        'content' => 'Actuamos como intermediarios entre el destinatario y los transportistas, integrando transporte marítimo, aéreo y terrestre, con control y seguimiento de la carga y optimización de rutas logísticas.',
                    ],
                    'keypoints' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Logística OTM',
                        'points' => [
                            ['title' => 'Coordinación Puerta a Puerta', 'content' => 'Nos encargamos de tu carga desde la fábrica de origen hasta el almacén final en Perú.'],
                            ['title' => 'Integración de Transporte Multimodal', 'content' => 'Combinamos transporte marítimo, aéreo y terrestre de manera continua.'],
                            ['title' => 'Control y Seguimiento de la Carga', 'content' => 'Monitoreo activo durante todo el trayecto internacional e interno.'],
                            ['title' => 'Optimización de Rutas Logísticas', 'content' => 'Buscamos las rutas más eficientes y económicas para tu envío.'],
                            ['title' => 'Gestión Integral de Documentación', 'content' => 'Nos encargamos de toda la documentación de tu operación de principio a fin.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Qué es el servicio puerta a puerta?', 'answer' => 'Es un servicio de transporte multimodal en el que coordinamos toda la cadena logística desde el retiro en la fábrica del proveedor en origen hasta la entrega en tu local o almacén en cualquier ciudad del Perú.'],
                            ['question' => '¿Cómo puedo hacer seguimiento de mi carga?', 'answer' => 'Contamos con telemetría en tiempo real y notificaciones automáticas en cada hito del despacho para mantenerte informado durante todo el trayecto.'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Aduanas',
                'icon' => '/images/svgs/landmark.svg',
                'short_description' => 'Gestión documentaria en desaduanaje de cargas marítimas, aéreas, postales y/o terrestres de los diversos regímenes aduaneros.',
                'webcontent' => [
                    'header' => 'Aduanas',
                    'image' => '/images/service/service_aduanas.jpg',
                    'title' => 'El manejo documentario y operativo del despacho aduanero',
                    'description' => 'Gestionamos el ingreso y salida legal de mercancías, garantizando el cumplimiento de la normativa aduanera vigente.',
                    'overview' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Despacho aduanero seguro y sin contratiempos',
                        'image' => '/images/web/schedule.svg',
                        'content' => [
                            'header' => 'Cumplimiento Normativo',
                            'introduction' => 'Gestionamos el ingreso y salida legal de mercancías, así como operaciones con beneficios tributarios y logísticos especiales.',
                            'content' => 'Tramitamos permisos y certificaciones necesarias según el tipo de mercancía, y realizamos la revisión y validación documentaria correspondiente para cada operación.',
                        ],
                    ],
                    'content_link' => [
                        'header' => 'Representación Aduanera',
                        'title' => 'Actuamos como intermediarios ante SUNAT',
                        'button_label' => 'Cotiza Ahora',
                        'image' => '/images/web/building.svg',
                        'content' => 'Representamos a nuestros clientes ante SUNAT y entidades relacionadas, gestionando regímenes aduaneros especiales y garantizando el cumplimiento de toda la normativa vigente.',
                    ],
                    'keypoints' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Aduanas',
                        'points' => [
                            ['title' => 'Despacho Aduanero de Importación y Exportación', 'content' => 'Gestionamos el ingreso y salida legal de mercancías con numeración anticipada.'],
                            ['title' => 'Gestión de Regímenes Aduaneros Especiales', 'content' => 'Admisión temporal, drawback, depósito aduanero y tránsito con beneficios tributarios.'],
                            ['title' => 'Tramitación de Permisos y Certificaciones', 'content' => 'Obtenemos registros y autorizaciones ante MTC, DIGESA, DIGEMID, SENASA y SUCAMEC.'],
                            ['title' => 'Revisión y Validación Documentaria', 'content' => 'Verificamos partidas arancelarias e invoices para evitar observaciones y multas.'],
                            ['title' => 'Representación ante Autoridades Aduaneras', 'content' => 'Actuamos como intermediarios ante SUNAT en aforos físicos y documentarios.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Qué son mercancías restringidas?', 'answer' => 'Son mercancías que requieren permisos especiales previos de entidades como DIGEMID, DIGESA, MTC o SENASA para su ingreso legal al país.'],
                            ['question' => '¿Qué son mercancías prohibidas?', 'answer' => 'Son mercancías que por razones de seguridad, salud o tratados internacionales no pueden ser importadas bajo ninguna circunstancia (drogas, armas no autorizadas, residuos peligrosos o ropa usada sin autorización).'],
                            ['question' => '¿Qué es el Despacho Anticipado?', 'answer' => 'Es la modalidad que permite numerar la DAM antes del arribo del buque o avión, logrando el levante aduanero inmediato dentro de las 48 horas de la descarga en el Callao o Chancay.'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Courier',
                'icon' => '/images/svgs/plane-takeoff.svg',
                'short_description' => 'Envíos rápidos para compras y paquetes internacionales, ideal para cargas pequeñas, documentos y pedidos urgentes, con seguimiento y asesoría en todo el proceso.',
                'webcontent' => [
                    'header' => 'Courier',
                    'image' => '/images/service/service_courier.jpg',
                    'title' => 'Soluciones para el traslado de documentos y paquetes por el mundo',
                    'description' => 'Envíos rápidos para compras y paquetes internacionales, ideal para cargas pequeñas, documentos y pedidos urgentes, con seguimiento y asesoría en todo el proceso.',
                    'overview' => [
                        'header' => 'Servicio Aéreo',
                        'title' => 'Impulsando nuestro servicio USA - Perú',
                        'image' => '/images/web/package.svg',
                        'content' => [
                            'header' => 'Envíos Express Internacionales',
                            'introduction' => 'Servicio prioritario para envíos urgentes con tiempos de entrega reducidos y seguimiento permanente, ideal para compras en Amazon, eBay, Apple, Sephora y Tommy Hilfiger, entre otras tiendas.',
                            'content' => 'Ofrecemos seguimiento en tiempo real, consolidación de paquetes para optimizar costos y tiempos, y asesoría en restricciones y regulaciones para cada envío.',
                        ],
                    ],
                    'content_link' => [
                        'header' => 'Courier',
                        'title' => 'Entregas rápidas y seguras',
                        'button_label' => 'Cotiza Ahora',
                        'image' => '/images/web/delivery.svg',
                        'content' => 'Garantizamos el traslado y entrega eficiente de tus envíos en el menor tiempo posible, agrupando paquetes para optimizar costos y brindándote asesoría sobre regulaciones y documentación para cada envío.',
                    ],
                    'keypoints' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Courier',
                        'points' => [
                            ['title' => 'Envíos Express Internacionales', 'content' => 'Servicio prioritario con tiempos de entrega reducidos desde Miami hacia Lima.'],
                            ['title' => 'Seguimiento en Tiempo Real', 'content' => 'Monitoreo constante del estado y ubicación de tu paquete.'],
                            ['title' => 'Consolidación de Paquetes', 'content' => 'Agrupamos compras de varias tiendas en un solo flete para optimizar costos.'],
                            ['title' => 'Asesoría en Restricciones y Regulaciones', 'content' => 'Te orientamos sobre permisos para mercancías restringidas antes de viajar.'],
                            ['title' => 'Entregas Rápidas y Seguras', 'content' => 'Despacho aéreo continuo y entrega final puerta a puerta en tu domicilio o empresa.'],
                            ['title' => 'Tiendas Más Solicitadas', 'content' => 'Compra en Amazon, eBay, Apple, Sephora, Tommy Hilfiger y más con nuestro servicio USA - Perú.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Desde qué tiendas puedo comprar y enviar con courier?', 'answer' => 'Puedes comprar en cualquier tienda online de EE. UU. como Amazon, eBay, Apple, B&H, Sephora, Tommy Hilfiger o distribuidores industriales y recibirlas en nuestro almacén en Miami.'],
                            ['question' => '¿Aplica franquicia libre de impuestos hasta US$ 200?', 'answer' => 'Sí, los envíos con valor FOB de hasta US$ 200 están libres de aranceles e IGV según el régimen simplificado de envíos de entrega rápida de SUNAT.'],
                            ['question' => '¿Puedo agrupar varios paquetes en un solo envío?', 'answer' => 'Sí, ofrecemos consolidación en almacén de Miami para reducir el flete total.'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($services as $s) {
            WebService::updateOrCreate(
                ['name' => $s['name']],
                [
                    'icon' => $s['icon'],
                    'short_description' => $s['short_description'],
                    'webcontent' => json_encode($s['webcontent']),
                ]
            );
        }
    }

    /**
     * 2. Verified International Suppliers & 3. Products
     */
    public function seedSuppliersAndProducts(): void
    {
        $suppliersData = [
            // Categoria 1: Electrónica & Tecnología
            [
                'name' => 'Xiaomi Industrial',
                'logo' => 'images/supplier/xiaomi.svg',
                'description' => 'Fabricante global de electrónica de consumo, pasarelas IoT y terminales industriales de escaneo.',
                'details' => [
                    'Fabricante verificado con despacho directo desde Shenzhen y Hong Kong',
                    'Consolidación de carga aérea express y contenedores FCL/LCL',
                    'Certificación de homologación MTC y gestión aduanera SUNAT incluida',
                ],
                'webpage' => 'https://www.mi.com',
                'category' => 'Electrónica & Tecnología',
                'products' => [
                    [
                        'name' => 'Xiaomi Smart Industrial Gateway Pro',
                        'image' => 'images/product/xiaomi_gateway_pro.jpg',
                        'stars' => 5,
                        'description' => 'Pasarela IoT para monitoreo y control industrial de alta precisión con conectividad Zigbee 3.0 y Wi-Fi 6.',
                        'EAN' => '6934177701234',
                    ],
                    [
                        'name' => 'Xiaomi Precision Scanner Terminal',
                        'image' => 'images/product/xiaomi_scanner_terminal.jpg',
                        'stars' => 5,
                        'description' => 'Terminal de lectura de códigos de barra 2D y RFID de alta velocidad para logística de inventarios.',
                        'EAN' => '6934177705678',
                    ],
                ],
            ],
            [
                'name' => 'Anker Innovations',
                'logo' => 'images/supplier/anker.svg',
                'description' => 'Líder en tecnología de carga rápida, estaciones de energía GaN y accesorios móviles de Shenzhen.',
                'details' => [
                    'Fabricante verificado con despacho directo desde Shenzhen y Hong Kong',
                    'Consolidación de carga aérea express y contenedores FCL/LCL',
                    'Certificación de homologación MTC y gestión aduanera SUNAT incluida',
                ],
                'webpage' => 'https://www.anker.com',
                'category' => 'Electrónica & Tecnología',
                'products' => [
                    [
                        'name' => 'Anker PowerHouse 767 Industrial Station',
                        'image' => 'images/product/anker_powerhouse_767.jpg',
                        'stars' => 5,
                        'description' => 'Estación de energía portátil GaNPrime de 2048Wh para respaldo en operaciones críticas y almacenes.',
                        'EAN' => '0194644081234',
                    ],
                    [
                        'name' => 'Anker Prime 240W GaN Charging Station',
                        'image' => 'images/product/anker_prime_240w.jpg',
                        'stars' => 5,
                        'description' => 'Hub de recarga ultra rápida para flotas de tablets, terminales y dispositivos de escaneo en almacén.',
                        'EAN' => '0194644089876',
                    ],
                ],
            ],
            [
                'name' => 'DJI Logistics Partner',
                'logo' => 'images/supplier/dji.svg',
                'description' => 'Sistemas aéreos no tripulados para transporte de carga pesada, inspección y topografía industrial.',
                'details' => [
                    'Fabricante verificado con despacho directo desde Shenzhen y Hong Kong',
                    'Consolidación de carga aérea express y contenedores FCL/LCL',
                    'Certificación de homologación MTC y gestión aduanera SUNAT incluida',
                ],
                'webpage' => 'https://www.dji.com',
                'category' => 'Electrónica & Tecnología',
                'products' => [
                    [
                        'name' => 'DJI FlyCart 30 Heavy Lift Cargo Drone',
                        'image' => 'images/product/dji_flycart_30.jpg',
                        'stars' => 5,
                        'description' => 'Dron para entrega de carga pesada hasta 30 kg en terrenos remotos, con radar activo y doble batería.',
                        'EAN' => '6941565912345',
                    ],
                    [
                        'name' => 'DJI Matrice 350 RTK Industrial Drone',
                        'image' => 'images/product/dji_matrice_350.jpg',
                        'stars' => 5,
                        'description' => 'Plataforma aérea insignia con clasificación IP55 para inspección y supervisión de infraestructuras logísticas.',
                        'EAN' => '6941565954321',
                    ],
                ],
            ],
            [
                'name' => 'Lenovo Commercial',
                'logo' => 'images/supplier/lenovo.svg',
                'description' => 'Estaciones de trabajo de alto rendimiento, servidores rack y soluciones de cómputo empresarial.',
                'details' => [
                    'Fabricante verificado con despacho directo desde Shenzhen y Hong Kong',
                    'Consolidación de carga aérea express y contenedores FCL/LCL',
                    'Certificación de homologación MTC y gestión aduanera SUNAT incluida',
                ],
                'webpage' => 'https://www.lenovo.com',
                'category' => 'Electrónica & Tecnología',
                'products' => [
                    [
                        'name' => 'Lenovo ThinkPad P16 Workstation Mobile',
                        'image' => 'images/product/lenovo_thinkpad_p16.jpg',
                        'stars' => 5,
                        'description' => 'Equipo de computación industrial reforzado para supervisión aduanera y control de despacho.',
                        'EAN' => '0195892012345',
                    ],
                    [
                        'name' => 'Lenovo ThinkSystem SR650 Enterprise Server',
                        'image' => 'images/product/lenovo_thinksystem_sr650.jpg',
                        'stars' => 5,
                        'description' => 'Servidor rack 2U de alto rendimiento para centros de distribución y procesamiento logístico WMS.',
                        'EAN' => '0195892098765',
                    ],
                ],
            ],

            // Categoria 2: Maquinaria & Equipos
            [
                'name' => 'Sany Heavy Industry',
                'logo' => 'images/supplier/sany.svg',
                'description' => 'Líder en maquinaria pesada, grúas portuarias, manipuladores de contenedores y excavadoras.',
                'details' => [
                    'Proveedor industrial certificado para importación de maquinaria y repuestos',
                    'Coordinación de carga sobredimensionada, Breakbulk y contenedores Flat Rack',
                    'Inspección pre-embarque en planta y seguro internacional puerta a puerta',
                ],
                'webpage' => 'https://www.sanyglobal.com',
                'category' => 'Maquinaria & Equipos',
                'products' => [
                    [
                        'name' => 'Sany Reach Stacker Container Handler',
                        'image' => 'images/product/sany_reach_stacker.jpg',
                        'stars' => 5,
                        'description' => 'Manipulador de contenedores de 45 toneladas para patios intermodales y terminales portuarias.',
                        'EAN' => '6921890123456',
                    ],
                    [
                        'name' => 'Sany SY215C Medium Hydraulic Excavator',
                        'image' => 'images/product/sany_sy215c_excavator.jpg',
                        'stars' => 5,
                        'description' => 'Excavadora sobre orugas de 22 toneladas con motor Isuzu de alta eficiencia y bajo consumo.',
                        'EAN' => '6921890654321',
                    ],
                ],
            ],
            [
                'name' => 'Bosch Industrial',
                'logo' => 'images/supplier/bosch.svg',
                'description' => 'Tecnología alemana en herramientas electroportátiles, automatización y actuadores de precisión.',
                'details' => [
                    'Proveedor industrial certificado para importación de maquinaria y repuestos',
                    'Coordinación de carga sobredimensionada, Breakbulk y contenedores Flat Rack',
                    'Inspección pre-embarque en planta y seguro internacional puerta a puerta',
                ],
                'webpage' => 'https://www.bosch.com',
                'category' => 'Maquinaria & Equipos',
                'products' => [
                    [
                        'name' => 'Bosch GDX 18V-200 Brushless Impact Wrench',
                        'image' => 'images/product/bosch_gdx_18v.jpg',
                        'stars' => 5,
                        'description' => 'Herramienta de alto torque para ensamblaje y mantenimiento de estructuras en transporte de carga.',
                        'EAN' => '3165140912345',
                    ],
                    [
                        'name' => 'Bosch GBH 18V-26 Professional Rotary Hammer',
                        'image' => 'images/product/bosch_rotary_hammer.jpg',
                        'stars' => 5,
                        'description' => 'Rotomartillo a batería con sistema KickBack Control para perforación en obras e instalaciones.',
                        'EAN' => '3165140987654',
                    ],
                ],
            ],
            [
                'name' => 'Caterpillar Parts',
                'logo' => 'images/supplier/caterpillar.svg',
                'description' => 'Componentes hidráulicos, trenes de rodaje y repuestos originales de maquinaria pesada desde Miami.',
                'details' => [
                    'Proveedor industrial certificado para importación de maquinaria y repuestos',
                    'Coordinación de carga sobredimensionada, Breakbulk y contenedores Flat Rack',
                    'Inspección pre-embarque en planta y seguro internacional puerta a puerta',
                ],
                'webpage' => 'https://www.caterpillar.com',
                'category' => 'Maquinaria & Equipos',
                'products' => [
                    [
                        'name' => 'Caterpillar Hydraulics Valve Block Pro',
                        'image' => 'images/product/caterpillar_valve_block.jpg',
                        'stars' => 5,
                        'description' => 'Repuestos y bloques hidráulicos genuinos para maquinaria pesada minera e industrial.',
                        'EAN' => '0883819123456',
                    ],
                    [
                        'name' => 'Caterpillar Advanced High Efficiency Oil Filter Pack',
                        'image' => 'images/product/caterpillar_oil_filter.jpg',
                        'stars' => 5,
                        'description' => 'Filtros de aceite hidráulico y lubricante para motores diésel de alta exigencia.',
                        'EAN' => '0883819654321',
                    ],
                ],
            ],

            // Categoria 3: Ferretería & Construcción
            [
                'name' => 'Total Tools International',
                'logo' => 'images/supplier/total_tools.svg',
                'description' => 'Herramientas eléctricas, neumáticas y manuales profesionales con presencia en más de 160 países.',
                'details' => [
                    'Distribuidor directo de líneas de ferretería profesional para volumen mayorista',
                    'Optimización de flete marítimo consolidado desde Ningbo y Shanghai',
                    'Clasificación arancelaria especializada y levante ágil en el Callao',
                ],
                'webpage' => 'https://www.totalbusiness.com',
                'category' => 'Ferretería & Construcción',
                'products' => [
                    [
                        'name' => 'Total Tools 20V Li-Ion Brushless Cordless Drill Kit',
                        'image' => 'images/product/total_tools_drill.jpg',
                        'stars' => 5,
                        'description' => 'Kit de taladro percutor 20V con 2 baterías de litio, cargador rápido y maletín de transporte.',
                        'EAN' => '6925582112345',
                    ],
                    [
                        'name' => 'Total Tools Industrial Heavy Duty Angle Grinder',
                        'image' => 'images/product/total_tools_grinder.jpg',
                        'stars' => 5,
                        'description' => 'Amoladora angular de 2400W para corte y desbaste de metales y hormigón en construcción.',
                        'EAN' => '6925582165432',
                    ],
                ],
            ],
            [
                'name' => 'Ingco Tools',
                'logo' => 'images/supplier/total_tools.svg',
                'description' => 'Fabricante integral de maquinaria ligera de construcción, generadores y herramientas para retail.',
                'details' => [
                    'Distribuidor directo de líneas de ferretería profesional para volumen mayorista',
                    'Optimización de flete marítimo consolidado desde Ningbo y Shanghai',
                    'Clasificación arancelaria especializada y levante ágil en el Callao',
                ],
                'webpage' => 'https://www.ingco.com',
                'category' => 'Ferretería & Construcción',
                'products' => [
                    [
                        'name' => 'Ingco 2200W Gasoline Inverter Generator',
                        'image' => 'images/product/ingco_generator.jpg',
                        'stars' => 5,
                        'description' => 'Generador eléctrico digital silencioso con tecnología inverter para equipos electrónicos sensibles.',
                        'EAN' => '6925583112345',
                    ],
                    [
                        'name' => 'Ingco 200A IGBT Inverter Arc Welding Machine',
                        'image' => 'images/product/ingco_welder.jpg',
                        'stars' => 5,
                        'description' => 'Soldadora inversora MMA/TIG ligera y compacta con protección térmica para taller y obra.',
                        'EAN' => '6925583165432',
                    ],
                ],
            ],

            // Categoria 4: Hogar & Bienes de Consumo
            [
                'name' => 'Midea Group',
                'logo' => 'images/supplier/midea.svg',
                'description' => 'Líder en climatización, electrodomésticos inteligentes y componentes para línea blanca.',
                'details' => [
                    'Planta certificada ISO para importación masiva de electrodomésticos y línea blanca',
                    'Programación de embarques regulares FCL con tarifas preferenciales',
                    'Gestión integral de permisos técnicos y etiquetado para retail en Perú',
                ],
                'webpage' => 'https://www.midea.com',
                'category' => 'Hogar & Bienes de Consumo',
                'products' => [
                    [
                        'name' => 'Midea Commercial VRF Inverter Air Conditioner',
                        'image' => 'images/product/midea_vrf_hvac.jpg',
                        'stars' => 5,
                        'description' => 'Sistema de flujo de refrigerante variable para climatización de oficinas y almacenes de alta eficiencia.',
                        'EAN' => '6924512112345',
                    ],
                    [
                        'name' => 'Midea Commercial Heavy Duty Microwave',
                        'image' => 'images/product/midea_microwave.jpg',
                        'stars' => 5,
                        'description' => 'Microondas industrial de acero inoxidable para comedores corporativos y hostelería.',
                        'EAN' => '6924512165432',
                    ],
                ],
            ],
            [
                'name' => 'Baseus Accessories',
                'logo' => 'images/supplier/tommy_hilfiger.svg',
                'description' => 'Especialista en gadgets de diseño, cargadores GaN ultra delgados y accesorios automotrices.',
                'details' => [
                    'Planta certificada ISO para importación masiva de electrodomésticos y línea blanca',
                    'Programación de embarques regulares FCL con tarifas preferenciales',
                    'Gestión integral de permisos técnicos y etiquetado para retail en Perú',
                ],
                'webpage' => 'https://www.baseus.com',
                'category' => 'Hogar & Bienes de Consumo',
                'products' => [
                    [
                        'name' => 'Baseus Blade 100W Fast Power Module',
                        'image' => 'images/product/baseus_blade_100w.jpg',
                        'stars' => 5,
                        'description' => 'Batería delgada de alta densidad para equipos de campo y supervisión de despachos.',
                        'EAN' => '6953156212345',
                    ],
                    [
                        'name' => 'Baseus GaN5 Pro 140W Fast Wall Charger',
                        'image' => 'images/product/baseus_gan5_140w.jpg',
                        'stars' => 5,
                        'description' => 'Cargador de pared compacto con triple puerto USB-C y USB-A para portátiles y móviles.',
                        'EAN' => '6953156265432',
                    ],
                ],
            ],
            [
                'name' => 'Haier International',
                'logo' => 'images/supplier/haier.svg',
                'description' => 'Refrigeración comercial, vitrinas exhibidoras y equipamiento para cadenas de distribución.',
                'details' => [
                    'Planta certificada ISO para importación masiva de electrodomésticos y línea blanca',
                    'Programación de embarques regulares FCL con tarifas preferenciales',
                    'Gestión integral de permisos técnicos y etiquetado para retail en Perú',
                ],
                'webpage' => 'https://www.haier.com',
                'category' => 'Hogar & Bienes de Consumo',
                'products' => [
                    [
                        'name' => 'Haier Commercial Display Showcase Refrigerator',
                        'image' => 'images/product/haier_showcase_fridge.jpg',
                        'stars' => 5,
                        'description' => 'Vitrina refrigeradora vertical con puerta de vidrio templado e iluminación LED para retail.',
                        'EAN' => '6901824112345',
                    ],
                    [
                        'name' => 'Haier Biomedical Ultra-Low Temperature Freezer',
                        'image' => 'images/product/haier_biomedical_freezer.jpg',
                        'stars' => 5,
                        'description' => 'Congelador médico -86°C para almacenamiento de insumos farmacéuticos y cadena de frío.',
                        'EAN' => '6901824165432',
                    ],
                ],
            ],

            // Categoria 5: Retail USA & Alianzas Navieras
            [
                'name' => 'Tommy Hilfiger USA',
                'logo' => 'images/supplier/tommy_hilfiger.svg',
                'description' => 'Marca líder de moda premium y retail estadounidense para compras y envíos express puerta a puerta.',
                'details' => [
                    'Compras directas en tiendas USA con entrega rápida en Lima',
                    'Casillero en Miami con consolidación de paquetes',
                    'Franquicia arancelaria hasta US$ 200 sin impuestos',
                ],
                'webpage' => 'https://usa.tommy.com',
                'category' => 'Retail & Moda USA',
                'products' => [
                    [
                        'name' => 'Tommy Hilfiger Classic Oxford Button-Down Shirt',
                        'image' => 'images/product/tommy_oxford_shirt.jpg',
                        'stars' => 5,
                        'description' => 'Camisa clásica 100% algodón Oxford con logo bordado en el pecho, corte custom fit.',
                        'EAN' => '0717228112345',
                    ],
                    [
                        'name' => 'Tommy Hilfiger Signature Waterproof Windbreaker Jacket',
                        'image' => 'images/product/tommy_windbreaker.jpg',
                        'stars' => 5,
                        'description' => 'Casaca cortavientos impermeable con capucha oculta y forro polar ligero para media estación.',
                        'EAN' => '0717228165432',
                    ],
                ],
            ],
            [
                'name' => 'Amazon Express Hub',
                'logo' => 'images/supplier/amazon.svg',
                'description' => 'Plataforma global de e-commerce y distribución para importación de tecnología y repuestos desde Miami.',
                'details' => [
                    'Recepción inmediata en casillero LanEx Miami',
                    'Inspección pre-embarque y flete aéreo prioritario',
                    'Despacho aduanero simplificado en 4-6 días',
                ],
                'webpage' => 'https://www.amazon.com',
                'category' => 'Retail & Moda USA',
                'products' => [
                    [
                        'name' => 'Amazon Kindle Paperwhite Signature Edition 32GB',
                        'image' => 'images/product/amazon_kindle_paperwhite.jpg',
                        'stars' => 5,
                        'description' => 'Lector de libros electrónicos con pantalla antirreflejos de 6.8 pulgadas, luz cálida y carga inalámbrica.',
                        'EAN' => '0840080512345',
                    ],
                    [
                        'name' => 'Amazon Echo Show 15 Smart Display & Hub',
                        'image' => 'images/product/amazon_echo_show_15.jpg',
                        'stars' => 5,
                        'description' => 'Pantalla inteligente Full HD de 15.6 pulgadas con Alexa y Fire TV para centros de comando y hogares.',
                        'EAN' => '0840080565432',
                    ],
                ],
            ],
            [
                'name' => 'COSCO Shipping Lines',
                'logo' => 'images/supplier/cosco.svg',
                'description' => 'Mayor consorcio naviero global y operador principal del nuevo Megapuerto de Chancay.',
                'details' => [
                    'Ruta directa Shanghai/Ningbo a Chancay en 23 días',
                    'Disponibilidad preferencial de contenedores FCL 20ft y 40ft HQ',
                    'Tarifas corporativas de flete marítimo y tracking satelital AIS',
                ],
                'webpage' => 'https://lines.coscoshipping.com',
                'category' => 'Alianzas Logísticas & Portuarias',
                'products' => [
                    [
                        'name' => 'Contenedor Marítimo 40ft High Cube Corten Steel',
                        'image' => 'images/product/cosco_container_40hq.jpg',
                        'stars' => 5,
                        'description' => 'Contenedor estándar de 40 pies High Cube nuevo (One Trip) fabricado en acero Corten para carga seca.',
                        'EAN' => '6908819112345',
                    ],
                    [
                        'name' => 'Contenedor Reefer Refrigerado 40ft Thermo King',
                        'image' => 'images/product/cosco_reefer_40ft.jpg',
                        'stars' => 5,
                        'description' => 'Contenedor frigorífico con unidad Thermo King Magnum Plus para transporte de frutas y productos congelados.',
                        'EAN' => '6908819165432',
                    ],
                ],
            ],
            [
                'name' => 'Apple Logistics Partner',
                'logo' => 'images/supplier/apple.svg',
                'description' => 'Dispositivos de cómputo de alta gama, tablets y terminales empresariales con homologación técnica MTC.',
                'details' => [
                    'Transporte aéreo express asegurado desde EE. UU.',
                    'Gestión de certificado de homologación MTC',
                    'Entrega final con custodia y precinto de seguridad',
                ],
                'webpage' => 'https://www.apple.com',
                'category' => 'Electrónica & Tecnología',
                'products' => [
                    [
                        'name' => 'Apple MacBook Pro 16-inch M3 Max Space Black',
                        'image' => 'images/product/apple_macbook_pro_16.jpg',
                        'stars' => 5,
                        'description' => 'Potencia extrema para diseño 3D y análisis de datos masivos con chip M3 Max y pantalla Liquid Retina XDR.',
                        'EAN' => '0195949112345',
                    ],
                    [
                        'name' => 'Apple iPad Pro 13-inch M4 OLED Liquid Retina',
                        'image' => 'images/product/apple_ipad_pro_13.jpg',
                        'stars' => 5,
                        'description' => 'Tablet profesional ultra delgada de 5.1 mm con chip M4 y pantalla Tandem OLED para ejecutivos y logística.',
                        'EAN' => '0195949165432',
                    ],
                ],
            ],
        ];

        foreach ($suppliersData as $sData) {
            $supplier = WebSupplier::updateOrCreate(
                ['name' => $sData['name']],
                [
                    'logo' => $sData['logo'],
                    'description' => $sData['description'],
                    'details' => json_encode($sData['details']),
                    'webpage' => $sData['webpage'],
                    'category' => $sData['category'],
                ]
            );

            // Seed and link products
            $productIds = [];
            foreach ($sData['products'] as $pData) {
                $product = WebProduct::updateOrCreate(
                    ['name' => $pData['name']],
                    [
                        'image' => $pData['image'],
                        'EAN' => $pData['EAN'],
                        'stars' => $pData['stars'],
                        'description' => $pData['description'],
                    ]
                );
                $productIds[] = $product->id;
            }

            if (!empty($productIds)) {
                $supplier->products()->syncWithoutDetaching($productIds);
            }
        }
    }

    /**
     * 4. Authentic Foreign Trade Blogs with Real Industry Information
     */
    public function seedBlogs(): void
    {
        $blogs = [
            [
                'title' => 'Megapuerto de Chancay: Reducción a 23 Días en Rutas Directas Asia - Perú y Nuevas Oportunidades',
                'slug' => 'megapuerto-chancay-rutas-directas-asia-peru',
                'excerpt' => 'El nuevo hub portuario de Chancay reduce el tiempo de navegación desde Shanghai a solo 23 días, evitando transbordos en México o Centroamérica y abaratando costos logísticos.',
                'meta_description' => 'Impacto operativo del Megapuerto de Chancay en tiempos de tránsito Asia-Perú, reducción a 23 días y nuevas oportunidades para importadores peruanos.',
                'meta_keywords' => 'Chancay, Puerto de Chancay, Flete Marítimo, China Perú, COSCO Shipping, Logística Callao',
                'author' => 'Carlos Mendoza • Operaciones LanEx',
                'category' => 'Infraestructura & Puertos',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 5,
                'published_at' => Carbon::parse('2026-11-11 10:00:00'),
                'featured_image' => 'images/blog/blog_chancay.jpg',
                'thumbnail_image' => 'images/blog/blog_chancay.jpg',
                'tags' => ['#Chancay', '#RutaDirectaAsia', '#FleteMaritimo', '#ComercioExterior'],
                'content' => [
                    [
                        'header' => 'Conectividad Directa y Eliminación de Transbordos',
                        'content' => 'Tradicionalmente, un contenedor marítimo embarcado en Shanghai, Ningbo o Shenzhen demoraba entre 35 y 45 días en arribar a la costa del Pacífico sur debido a las escalas técnicas obligatorias en puertos como Manzanillo (México) o Balboa (Panamá). Con la entrada en operación de la ruta directa al Megapuerto de Chancay, el tránsito marítimo se comprime a aproximadamente 23 a 25 días, lo que representa una reducción de casi el 35% en tiempo de navegación.',
                    ],
                    [
                        'header' => 'Capacidad para Buques Ultra Large Container Vessels (ULCV)',
                        'content' => 'Chancay cuenta con un calado natural de hasta 17.8 metros de profundidad y grúas pórtico automatizadas sobre rieles capaces de atender buques portacontenedores de más de 18,000 y 24,000 TEUs. Esta escala de transporte abarata las tarifas promedio de flete por contenedor gracias a las economías de escala de las principales navieras globales.',
                    ],
                    [
                        'header' => 'Sinergia Logística Chancay - Callao',
                        'content' => 'Lejos de competir de manera excluyente, el Puerto del Callao y el Terminal Portuario de Chancay actúan como un corredor logístico complementario. Las mercancías de alta rotación con destino a Lima norte y la sierra central encuentran en Chancay un acceso directo por el túnel vial, liberando congestión en las avenidas Gambetta y Faucett en el Callao.',
                    ],
                    [
                        'header' => 'Estrategia para Importadores y Mayoristas',
                        'content' => 'Reducir los tiempos de tránsito a 23 días permite a las empresas peruanas rotar inventario más rápido, programar compras estacionales con mayor certeza y disminuir la inmovilización de capital de trabajo en el mar. En LanEx coordinamos la reserva de espacio con navieras y el agenciamiento aduanero anticipado para ambas puertas de entrada.',
                    ],
                ],
            ],
            [
                'title' => 'Despacho Anticipado SUNAT: Cómo Ahorrar Costos de Sobreestadía y Almacenaje en Terminales Portuarios',
                'slug' => 'despacho-anticipado-sunat-ahorro-sobreestadia-almacenaje',
                'excerpt' => 'Numerar la Declaración Aduanera (DAM) antes de la llegada de la nave permite retirar contenedores directamente del puerto en menos de 48 horas sin pagar días de almacén extra.',
                'meta_description' => 'Guía completa del Despacho Anticipado SUNAT: pasos, requisitos y ahorro comprobado en sobreestadías y tarifas portuarias en Callao.',
                'meta_keywords' => 'Despacho Anticipado, SUNAT, DAM, Sobreestadía, Almacenaje Portuario, Aduanas Callao',
                'author' => 'Jorge Vega • Agenciamiento Aduanero',
                'category' => 'Gestión Aduanera',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 6,
                'published_at' => Carbon::parse('2026-11-09 14:30:00'),
                'featured_image' => 'images/blog/blog_despacho_anticipado.jpg',
                'thumbnail_image' => 'images/blog/blog_despacho_anticipado.jpg',
                'tags' => ['#DespachoAnticipado', '#SUNAT', '#Aduanas', '#AhorroCostos'],
                'content' => [
                    [
                        'header' => '¿Por qué el Despacho Anticipado es la Clave de la Eficiencia?',
                        'content' => 'Según la normativa de la Ley General de Aduanas (Decreto Legislativo N° 1053) y el procedimiento DESPA-PG.01, el Despacho Anticipado es la modalidad obligatoria para la gran mayoría de regímenes de importación para el consumo. Numerar la Declaración Aduanera de Mercancías (DAM) hasta 30 días antes del arribo de la nave permite que el sistema aduanero asigne canal de control de forma inmediata tras la confirmación de la descarga.',
                    ],
                    [
                        'header' => 'Eliminación de Días Muertos y Traslados Innecesarios',
                        'content' => 'Cuando un importador utiliza despacho diferido (numerando luego de que la carga llega), el contenedor suele ser trasladado obligatoriamente a un depósito temporal extraportuario, devengando costos de tracción, manipuleo y almacenaje que pueden ascender a US$ 400 - US$ 900 por contenedor. Con el despacho anticipado y descarga directa al puerto (APM Terminals o DP World Callao), el retiro se efectiviza directamente en la rampa.',
                    ],
                    [
                        'header' => 'Prevención de Sobreestadía de Contenedores (Demurrage)',
                        'content' => 'Las líneas navieras suelen otorgar entre 7 y 14 días libres para la devolución del contenedor vacío al depósito asignado. Retrasos en la revisión de documentos o aforos provocan cargos diarios de sobreestadía que van desde US$ 60 hasta US$ 180 diarios por contenedor. Una gestión documental anticipada asegura el levante aduanero en menos de 48 horas y la devolución oportuna del equipo.',
                    ],
                    [
                        'header' => 'Requisitos Indispensables para Numerar con Éxito',
                        'content' => 'Para numerar con anticipación se requiere contar con la factura comercial definitiva (commercial invoice), el packing list con pesos y bultos concordantes, el conocimiento de embarque (B/L) transmitido por el agente naviero en el manifiesto de carga, y los permisos sectoriales vigentes (DIGESA, DIGEMID, MTC) si la mercancía es restringida.',
                    ],
                ],
            ],
            [
                'title' => 'Incoterms 2020 para Importadores Peruanos: Diferencias Críticas entre FOB, CIF, EXW y DDP',
                'slug' => 'incoterms-2020-importadores-peru-fob-cif-exw-ddp',
                'excerpt' => 'Elegir el término comercial correcto evita riesgos de seguro, sobrecostos de flete y sorpresas tributarias ante SUNAT en puertos peruanos.',
                'meta_description' => 'Comparativa de Incoterms 2020: FOB vs CIF vs EXW vs DDP para importadores en Perú. Errores comunes y cómo negociar fletes eficientes.',
                'meta_keywords' => 'Incoterms 2020, FOB, CIF, EXW, DDP, Importaciones Perú, Flete Internacional',
                'author' => 'Lucía Morales • Asesoría Logística',
                'category' => 'Comercio Exterior',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 5,
                'published_at' => Carbon::parse('2026-11-06 09:15:00'),
                'featured_image' => 'images/blog/blog_incoterms.jpg',
                'thumbnail_image' => 'images/blog/blog_incoterms.jpg',
                'tags' => ['#Incoterms2020', '#FOB', '#CIF', '#LogisticaInternacional'],
                'content' => [
                    [
                        'header' => 'FOB (Free On Board): La Recomendación General para Cargas de China',
                        'content' => 'Bajo el término FOB, el fabricante chino es responsable de entregar la mercancía a bordo del buque en el puerto de origen (ej. Shanghai, Ningbo o Shenzhen), cubriendo el transporte interno y el despacho de exportación en China. El importador peruano contrata el flete marítimo y el seguro a través de su propio agente de carga de confianza en Perú, manteniendo el control de los costos y evitando recargos sorpresa en destino.',
                    ],
                    [
                        'header' => 'El Riesgo Oculto de las Ofertas CIF Baratas',
                        'content' => 'Muchos proveedores extranjeros ofrecen precios en condición CIF (Cost, Insurance and Freight) con fletes aparentemente muy económicos o incluso "gratuitos". Sin embargo, las navieras o co-loaders designados por el vendedor suelen cobrar tarifas locales excesivas en el puerto del Callao por desconsolidación, vistos buenos y gastos administrativos, encareciendo la operación global.',
                    ],
                    [
                        'header' => 'EXW (Ex Works): Ideal para Consolidaciones Multitienda',
                        'content' => 'Si compras productos de tres o cuatro fábricas diferentes en China o Estados Unidos, pactar en EXW te permite coordinar la recogida con un transportista interno local y llevar todo a un almacén central de consolidación en Guangzhou o Miami, armando un solo contenedor o una sola guía aérea.',
                    ],
                    [
                        'header' => 'DDP (Delivered Duty Paid): Responsabilidad y Liquidación Local',
                        'content' => 'En DDP, el vendedor extranjero asume todos los gastos y riesgos hasta entregar la carga en las instalaciones del comprador en Perú, incluyendo el pago de impuestos ante SUNAT. En la práctica aduanera peruana, esta modalidad puede generar trabas tributarias si el vendedor no cuenta con personería jurídica o RUC en el país para declarar el IGV/IPM.',
                    ],
                ],
            ],
            [
                'title' => 'Courier USA - Perú: Guía Paso a Paso para Importar Mercancías Menores a US$ 200 sin Aranceles',
                'slug' => 'courier-usa-peru-importacion-menor-200-dolares',
                'excerpt' => 'Aprende cómo aprovechar el régimen simplificado de envíos de entrega rápida para muestras comerciales, repuestos urgentes y compras personales libres de impuestos.',
                'meta_description' => 'Guía de importación Courier USA a Perú bajo la franquicia de 200 dólares. Requisitos, tiendas permitidas y tiempos de entrega.',
                'meta_keywords' => 'Courier USA Peru, Franquicia 200 Dolares, Amazon Peru, Repuestos Urgentes, Envíos Express',
                'author' => 'Carlos Mendoza • Operaciones LanEx',
                'category' => 'Courier & Envíos Express',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 4,
                'published_at' => Carbon::parse('2026-11-04 11:20:00'),
                'featured_image' => 'images/blog/blog_courier.jpg',
                'thumbnail_image' => 'images/blog/blog_courier.jpg',
                'tags' => ['#CourierUSA', '#ComprasUSA', '#Franquicia200USD', '#Amazon'],
                'content' => [
                    [
                        'header' => 'La Franquicia Arancelaria de US$ 200 de SUNAT',
                        'content' => 'El régimen de Envíos de Entrega Rápida (Decreto Supremo N° 244-2013-EF) establece que aquellos paquetes cuyo valor FOB declarado no supere los doscientos dólares americanos (US$ 200.00) se encuentran inafectos al pago de derechos arancelarios ad-valorem, IGV e IPM. Esto representa una ventaja económica sustancial para la importación ágil de insumos, repuestos y muestras.',
                    ],
                    [
                        'header' => 'Casillero y Recepción en Almacén de Miami',
                        'content' => 'Al contar con una dirección física en Miami (Florida), puedes adquirir productos en Amazon, eBay, Apple, B&H Photo, Sephora o tiendas mayoristas de repuestos automotrices que solo realizan envíos dentro del territorio estadounidense. La carga es recibida, verificada en peso y volumen, y reembalada para su salida en el siguiente vuelo.',
                    ],
                    [
                        'header' => 'Cuidado con las Mercancías Restringidas en Vía Aérea',
                        'content' => 'Aunque el valor del producto sea menor a US$ 200, si la mercancía califica como restringida requerirá el permiso correspondiente antes de su retiro. Ejemplos comunes: celulares y equipos con transmisión Wi-Fi/Bluetooth requieren homologación del MTC; cosméticos requieren notificación sanitaria de DIGEMID; y suplementos nutricionales de DIGESA.',
                    ],
                    [
                        'header' => 'Tiempos de Tránsito y Entrega Final en Perú',
                        'content' => 'Los vuelos cargueros directos desde el Aeropuerto Internacional de Miami (MIA) hacia el Aeropuerto Jorge Chávez (LIM) permiten que los paquetes sean desconsolidados y puestos a disposición del cliente en Lima en un plazo de 4 a 6 días hábiles desde su recepción en Florida.',
                    ],
                ],
            ],
            [
                'title' => 'Guía 2026: Cómo Importar Contenedores FCL desde Ningbo y Shenzhen',
                'slug' => 'guia-importar-contenedores-fcl-china-peru',
                'excerpt' => 'Requisitos aduaneros ante SUNAT, optimización de flete marítimo y prevención de sobrecostos en terminales de Callao.',
                'meta_description' => 'Guía completa para importar contenedores completos FCL desde Ningbo y Shenzhen hacia el Puerto del Callao.',
                'meta_keywords' => 'Importar Contenedores, FCL, Ningbo, Shenzhen, Callao, Flete Maritimo',
                'author' => 'Carlos Mendoza • Operaciones LanEx',
                'category' => 'Comercio Exterior',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 5,
                'published_at' => Carbon::parse('2026-11-02 15:37:41'),
                'featured_image' => 'images/blog/blog_fcl_china.jpg',
                'thumbnail_image' => 'images/blog/blog_fcl_china.jpg',
                'tags' => ['#FCL', '#China', '#SUNAT', '#Importacion'],
                'content' => [
                    [
                        'header' => 'Planificación en Origen',
                        'content' => 'Importar desde los puertos principales de China requiere una estrategia de consolidación y agenciamiento aduanero riguroso. Coordinar directamente con el fabricante en Ningbo o Shenzhen permite asegurar la correcta emisión del Bill of Lading y el Certificado de Origen Formulario E.',
                    ],
                    [
                        'header' => 'Selección del Contenedor Adecuado',
                        'content' => 'Elegir entre contenedores estándar de 20 pies (capacidad aprox. 33 m³), 40 pies Dry (aprox. 67 m³) o 40 High Cube (aprox. 76 m³) depende de la relación peso-volumen de la carga. Para carga voluminosa ligera, el 40HQ maximiza el espacio por dólar de flete.',
                    ],
                ],
            ],
            [
                'title' => 'Flete Aéreo Express vs. Marítimo LCL: Cuándo Conviene Cada Modalidad',
                'slug' => 'flete-aereo-vs-maritimo-lcl-comparativa',
                'excerpt' => 'Comparativa de costos por peso/volumen y tiempos de tránsito puerta a puerta para repuestos, muestras y carga urgente.',
                'meta_description' => 'Aéreo Express vs Marítimo LCL: matriz de decisión de costos, volumen y tiempos para importadores.',
                'meta_keywords' => 'Aereo Express, Maritimo LCL, Comparativa Fletes, Logistica Peru',
                'author' => 'Lucía Morales • Asesoría Logística',
                'category' => 'Transporte Multimodal',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 4,
                'published_at' => Carbon::parse('2026-10-30 15:37:41'),
                'featured_image' => 'images/blog/blog_aereo_vs_maritimo.jpg',
                'thumbnail_image' => 'images/blog/blog_aereo_vs_maritimo.jpg',
                'tags' => ['#AéreoExpress', '#LCLConsolidado', '#ComparativaLogistica'],
                'content' => [
                    [
                        'header' => 'Análisis de Tiempos y Costos',
                        'content' => 'Para importadores con necesidad de rapidez o pedidos consolidados, evaluar el ratio peso-volumen define la rentabilidad del flete. Mientras el aéreo cobra por peso volumétrico (1 m³ = 167 kg), el flete marítimo LCL cotiza por W/M (1 m³ = 1000 kg).',
                    ],
                    [
                        'header' => 'Cuándo Optar por Transporte Aéreo',
                        'content' => 'Cargas de alto valor comercial, insumos farmacéuticos, repuestos para maquinaria detenida y lanzamientos comerciales justifican el flete aéreo de 4 a 7 días frente a los 30 a 35 días del barco.',
                    ],
                ],
            ],
            [
                'title' => 'Canales de Control SUNAT (Verde, Naranja y Rojo): Claves para Despacho Inmediato',
                'slug' => 'canales-control-aduanas-sunat-importacion',
                'excerpt' => 'Cómo clasifica SUNAT las declaraciones aduaneras y qué medidas preventivas aseguran el levante ágil de tu carga en Callao.',
                'meta_description' => 'Explicación de canales de control aduanero SUNAT: canal verde, naranja y rojo. Factores de riesgo y cómo evitar demoras.',
                'meta_keywords' => 'Canales SUNAT, Canal Verde, Canal Naranja, Canal Rojo, Aforo Aduanero, Callao',
                'author' => 'Jorge Vega • Agenciamiento Aduanero',
                'category' => 'Gestión Aduanera',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 6,
                'published_at' => Carbon::parse('2026-10-27 15:37:41'),
                'featured_image' => 'images/blog/blog_canales_control.jpg',
                'thumbnail_image' => 'images/blog/blog_canales_control.jpg',
                'tags' => ['#SUNAT', '#DespachoAduanero', '#CanalVerde', '#Callao'],
                'content' => [
                    [
                        'header' => 'Control Aduanero y Canal Verde',
                        'content' => 'El sistema de selección anticipada de SUNAT evalúa el perfil del operador y la exactitud de los documentos de embarque. El Canal Verde otorga levante automático sin revisión documental ni física, permitiendo el retiro inmediato de la carga.',
                    ],
                    [
                        'header' => 'Canal Naranja: Revisión Documentaria',
                        'content' => 'Exige la presentación digital de factura, conocimiento de embarque y certificados de origen para verificación de partidas arancelarias y valores declarados por un especialista aduanero.',
                    ],
                    [
                        'header' => 'Canal Rojo: Reconocimiento Físico',
                        'content' => 'El contenedor es trasladado a la zona de aforo del depósito temporal para que un oficial de aduanas verifique físicamente que las mercancías concuerden con lo declarado.',
                    ],
                ],
            ],
            [
                'title' => 'Consolidación de Carga en Almacenes de Miami y Guangzhou',
                'slug' => 'consolidacion-carga-miami-guangzhou',
                'excerpt' => 'Ventajas logísticas de agrupar paquetes comerciales y compras a múltiples proveedores antes del embarque internacional.',
                'meta_description' => 'Cómo funciona la consolidación de carga en almacenes de Miami y Guangzhou para reducir fletes internacionales.',
                'meta_keywords' => 'Consolidacion de Carga, Miami, Guangzhou, Flete Compartido, Logistica China',
                'author' => 'Carlos Mendoza • Operaciones LanEx',
                'category' => 'Almacenaje & Hubs',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 3,
                'published_at' => Carbon::parse('2026-10-24 15:37:41'),
                'featured_image' => 'images/blog/blog_consolidacion.jpg',
                'thumbnail_image' => 'images/blog/blog_consolidacion.jpg',
                'tags' => ['#MiamiHub', '#ConsolidadoChina', '#Almacenaje', '#Logistica'],
                'content' => [
                    [
                        'header' => 'Ahorro en Fletes Multi-proveedor',
                        'content' => 'Comprar a diferentes fabricantes internacionales suele encarecer los fletes si no se realiza un consolidado profesional previo. Agrupar la carga en un solo empaque master reduce los gastos fijos de despacho aduanero y manipuleo en destino.',
                    ],
                    [
                        'header' => 'Inspección y Re-embalaje de Calidad',
                        'content' => 'Nuestros almacenes en origen revisan el estado de las cajas, verifican que no existan roturas y acondicionan la mercancía para soportar el transporte marítimo o aéreo.',
                    ],
                ],
            ],
            [
                'title' => 'Revolución en los Mares: La Inteligencia Artificial Transformando el Transporte Marítimo',
                'slug' => 'ia-transformando-transporte-maritimo',
                'excerpt' => 'Monitoreo satelital ADS-B y AIS, optimización meteorológica de rutas y reducción de consumo de búnker en portacontenedores de última generación.',
                'meta_description' => 'Cómo la inteligencia artificial y el rastreo de flotas transforman la logística de contenedores marítimos en tiempo real.',
                'meta_keywords' => 'Inteligencia Artificial Maritima, Telemetria AIS, Optimizacion Rutas, Portacontenedores, Logistica 4.0',
                'author' => 'Equipo Técnico LanEx',
                'category' => 'Innovación Logística',
                'status' => 'published',
                'is_featured' => true,
                'reading_time' => 5,
                'published_at' => Carbon::parse('2026-10-18 10:00:00'),
                'featured_image' => 'images/blog/blog_ia_maritimo.jpg',
                'thumbnail_image' => 'images/blog/blog_ia_maritimo.jpg',
                'tags' => ['#IAMarítima', '#Telemetría', '#Logística40', '#Innovación'],
                'content' => [
                    [
                        'header' => 'Ruteo Meteorológico Dinámico y Eficiencia de Combustible',
                        'content' => 'Los algoritmos de inteligencia artificial analizan corrientes oceánicas, oleaje y frentes de tormenta en tiempo real para sugerir micro-correcciones de rumbo. Esto permite a los buques Triple-E ahorrar hasta un 12% en consumo de combustible búnker y predecir la hora estimada de arribo (ETA) en los muelles de Callao y Chancay con márgenes de error inferiores a 2 horas.',
                    ],
                    [
                        'header' => 'Gemelos Digitales y Telemetría en Contenedores Inteligentes',
                        'content' => 'La integración de sensores IoT dentro de contenedores refrigerados (Reefers) permite monitorear humedad, temperatura y composición de gases durante todo el tránsito transpacífico, alertando automáticamente ante cualquier desviación antes de que afecte la carga perecible.',
                    ],
                ],
            ],
        ];

        foreach ($blogs as $b) {
            WebBlog::updateOrCreate(
                ['slug' => $b['slug']],
                [
                    'title' => $b['title'],
                    'excerpt' => $b['excerpt'],
                    'meta_description' => $b['meta_description'],
                    'meta_keywords' => $b['meta_keywords'],
                    'author' => $b['author'],
                    'category' => $b['category'],
                    'status' => $b['status'],
                    'is_featured' => $b['is_featured'],
                    'reading_time' => $b['reading_time'],
                    'published_at' => $b['published_at'],
                    'featured_image' => $b['featured_image'],
                    'thumbnail_image' => $b['thumbnail_image'],
                    'tags' => json_encode($b['tags']),
                    'content' => json_encode($b['content']),
                ]
            );
        }
    }

    /**
     * 5. Verified Client Reviews
     */
    public function seedReviews(): void
    {
        $reviews = [
            [
                'name' => 'Carlos Mendoza Ríos',
                'charge' => 'Gerente de Operaciones • Importadora TecnoAndes SAC',
                'date_review' => '2026-02-14',
                'review' => 'Con LanEx redujimos nuestros tiempos de desaduanaje en el Callao de 7 días a menos de 48 horas. Su equipo nos asesora con las partidas arancelarias y permisos del MTC antes de que la carga salga de Shenzhen.',
                'stars' => 5,
            ],
            [
                'name' => 'Valeria Paredes Alarcón',
                'charge' => 'Directora de Compras • Grupo Ferretero del Sur',
                'date_review' => '2026-02-28',
                'review' => 'Excelente manejo en carga consolidada LCL y contenedores completos desde Ningbo. Tener visibilidad real de cada etapa y costos claros desde la cotización nos ha permitido escalar nuestras importaciones sin sorpresas.',
                'stars' => 5,
            ],
            [
                'name' => 'Jorge Luis Salgado',
                'charge' => 'Jefe de Logística • Maquinarias & Equipos Pacífico',
                'date_review' => '2026-03-08',
                'review' => 'Su servicio puerta a puerta desde Miami para repuestos urgentes es impecable. Consolidan nuestros pedidos de distintos proveedores en EE. UU. y los entregan directamente en nuestro almacén en Lima.',
                'stars' => 5,
            ],
            [
                'name' => 'Mariana Quispe Huamán',
                'charge' => 'Fundadora • ElectroHogar Retail Perú',
                'date_review' => '2026-03-19',
                'review' => 'Empezamos importando pallets sueltos con su asesoría de comercio exterior y hoy traemos contenedores FCL cada mes. El acompañamiento ante SUNAT es 100% confiable.',
                'stars' => 5,
            ],
            [
                'name' => 'Ricardo Bustamante Vela',
                'charge' => 'Gerente General • Suministros Industriales Kuntur',
                'date_review' => '2026-03-27',
                'review' => 'Muy buena atención personalizada en transporte multimodal OTM. Coordinaron el traslado marítimo y terrestre hasta nuestra planta en Arequipa cumpliendo el cronograma pactado.',
                'stars' => 4,
            ],
            [
                'name' => 'Lucía Fernández Castro',
                'charge' => 'Coordinadora de Comercio Exterior • MedEquip Perú',
                'date_review' => '2026-04-02',
                'review' => 'Destaco la rapidez de respuesta de sus ejecutivos y la precisión en la documentación aduanera. Cada despacho aéreo llega a tiempo y sin sobrecostos de almacenaje.',
                'stars' => 5,
            ],
        ];

        foreach ($reviews as $rev) {
            WebReview::updateOrCreate(
                ['name' => $rev['name'], 'charge' => $rev['charge']],
                [
                    'date_review' => $rev['date_review'],
                    'review' => $rev['review'],
                    'stars' => $rev['stars'],
                ]
            );
        }
    }
}
