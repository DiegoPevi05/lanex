<?php

namespace Database\Seeders;

use App\Models\WebService;
use Illuminate\Database\Seeder;

/**
 * Seeds the 5 real LanEx (ExpressLane Logistics S.A.C.) services taken
 * from the official company brochure (public/brochure_lanex.pdf).
 *
 * Run with: php artisan db:seed --class=LanexServicesSeeder
 */
class LanexServicesSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->services() as $service) {
            WebService::updateOrCreate(
                ['name' => $service['name']],
                [
                    'icon' => $service['icon'],
                    'short_description' => $service['short_description'],
                    'webcontent' => json_encode($service['webcontent']),
                ]
            );
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function services(): array
    {
        return [
            [
                'name' => 'Asesoría y Consultoría',
                'icon' => '/images/svgs/scale.svg',
                'short_description' => 'Servicio de asesoría personalizada, soporte en operaciones de comercio exterior y aduanas, así como soluciones logísticas de manera eficiente.',
                'webcontent' => [
                    'header' => 'Asesoría y Consultoría',
                    'image' => '/images/web/services.webp',
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
                            ['title' => 'Orientación en Normativas Aduaneras Vigentes', 'content' => 'Te mantenemos al día con la normativa aduanera vigente.'],
                            ['title' => 'Planeamiento Estratégico de Operaciones Internacionales', 'content' => 'Diseñamos la estrategia logística ideal para tu negocio.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Qué incluye el servicio de asesoría?', 'answer' => 'Incluye asesoría en importaciones y exportaciones, evaluación de costos logísticos, orientación en normativas aduaneras vigentes y planeamiento estratégico de tus operaciones internacionales.'],
                            ['question' => '¿Puedo importar si no cuento con RUC?', 'answer' => 'Las personas naturales pueden realizar importaciones ocasionales cuyo valor FOB no exceda los límites establecidos por SUNAT. Te asesoramos para conocer si tu caso aplica.'],
                            ['question' => '¿Cuáles son los requisitos para exportar e importar?', 'answer' => 'Entre los documentos básicos se encuentran la factura comercial, el conocimiento de embarque, el certificado de origen, la póliza de seguro y la lista de empaque, entre otros según el régimen aduanero.'],
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
                    'image' => '/images/web/services.webp',
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
                        'content' => 'Servicio FCL (Full Container Load): transporte marítimo exclusivo de un contenedor 20\', 40\'HC, 40\' Reefer y 40\'NOR. Servicio LCL (Less Container Load): transporte marítimo compartido para movilizar carga con poco volumen. Servicio Breakbulk: transporte de cargas a granel según el tipo, tamaño, capacidad y manipulación requeridos.',
                    ],
                    'keypoints' => [
                        'header' => 'Nuestros Servicios',
                        'title' => 'Agencia de Carga',
                        'points' => [
                            ['title' => 'SOUL Clientes', 'content' => 'Plataforma para el seguimiento de tus operaciones en todo momento.'],
                            ['title' => 'Transporte Aéreo', 'content' => 'Importaciones y exportaciones por vía aérea.'],
                            ['title' => 'Transporte Marítimo', 'content' => 'Importaciones y exportaciones por vía marítima.'],
                            ['title' => 'Carga de Proyectos', 'content' => 'Soluciones especiales para cargas de gran envergadura.'],
                            ['title' => 'Carga con Requerimientos Especiales', 'content' => 'Manejo de cargas que requieren condiciones específicas.'],
                            ['title' => 'Carga Refrigerada o Seca', 'content' => 'Transporte adaptado según el tipo de mercancía.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Cuál es la diferencia entre FCL y LCL?', 'answer' => 'FCL es el uso exclusivo de un contenedor completo, mientras que LCL es un servicio compartido ideal para cargas de menor volumen.'],
                            ['question' => '¿Cuáles son los principales países de importación?', 'answer' => 'Trabajamos con más de 20 países, siendo los principales USA, España, China y Chile.'],
                            ['question' => '¿Cómo puedo realizar un seguimiento de mi envío?', 'answer' => 'Puedes realizar el seguimiento en tiempo real a través de nuestra plataforma en línea con el número de seguimiento que te proporcionamos.'],
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
                    'image' => '/images/web/services.webp',
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
                            ['title' => 'Coordinación Puerta a Puerta', 'content' => 'Nos encargamos de tu carga desde el origen hasta el destino final.'],
                            ['title' => 'Integración de Transporte Multimodal', 'content' => 'Combinamos transporte marítimo, aéreo y terrestre.'],
                            ['title' => 'Control y Seguimiento de la Carga', 'content' => 'Monitoreamos tu carga durante todo el trayecto.'],
                            ['title' => 'Optimización de Rutas Logísticas', 'content' => 'Buscamos las rutas más eficientes para tu envío.'],
                            ['title' => 'Gestión Integral de Documentación', 'content' => 'Nos encargamos de toda la documentación de tu operación.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Qué es el servicio puerta a puerta?', 'answer' => 'Es un servicio de transporte multimodal en el que actuamos como intermediarios, coordinando toda la operación desde el origen hasta el destino final de tu carga.'],
                            ['question' => '¿Cómo puedo hacer seguimiento de mi carga?', 'answer' => 'Contamos con control y seguimiento constante de la carga, y te mantenemos informado durante todo el trayecto de la operación.'],
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
                    'image' => '/images/web/services.webp',
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
                            ['title' => 'Despacho Aduanero de Importación y Exportación', 'content' => 'Gestionamos el ingreso y salida legal de mercancías.'],
                            ['title' => 'Gestión de Regímenes Aduaneros Especiales', 'content' => 'Operaciones con beneficios tributarios y logísticos especiales.'],
                            ['title' => 'Tramitación de Permisos y Certificaciones', 'content' => 'Obtenemos las autorizaciones necesarias según el tipo de mercancía.'],
                            ['title' => 'Revisión y Validación Documentaria', 'content' => 'Verificamos que toda la documentación cumpla con lo requerido.'],
                            ['title' => 'Representación ante Autoridades Aduaneras', 'content' => 'Actuamos como intermediarios ante SUNAT y entidades relacionadas.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Qué son mercancías restringidas?', 'answer' => 'Son mercancías con limitaciones para su importación o exportación por razones sanitarias, ambientales, de seguridad o de protección de la industria local, entre otras.'],
                            ['question' => '¿Qué son mercancías prohibidas?', 'answer' => 'Son mercancías que no pueden ser importadas o exportadas bajo ninguna circunstancia, como drogas, armas no autorizadas o especies en peligro de extinción.'],
                            ['question' => '¿Cómo calculan sus tarifas?', 'answer' => 'Nuestras tarifas se calculan según el peso y volumen de la carga, la distancia, el tipo de servicio y cualquier servicio adicional que solicites.'],
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
                    'image' => '/images/web/services.webp',
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
                            ['title' => 'Envíos Express Internacionales', 'content' => 'Servicio prioritario con tiempos de entrega reducidos.'],
                            ['title' => 'Seguimiento en Tiempo Real', 'content' => 'Monitoreo constante del estado y ubicación de tu carga.'],
                            ['title' => 'Consolidación de Paquetes', 'content' => 'Agrupamos varios paquetes para optimizar costos y tiempos.'],
                            ['title' => 'Asesoría en Restricciones y Regulaciones', 'content' => 'Te orientamos sobre la documentación necesaria para cada envío.'],
                            ['title' => 'Entregas Rápidas y Seguras', 'content' => 'Garantizamos el traslado y entrega eficiente en el menor tiempo posible.'],
                            ['title' => 'Tiendas Más Solicitadas', 'content' => 'Compra en Amazon, eBay, Apple, Sephora, Tommy Hilfiger y más, impulsando nuestro servicio USA - Perú.'],
                        ],
                    ],
                    'faqs' => [
                        'title' => 'Preguntas Frecuentes',
                        'questions' => [
                            ['question' => '¿Desde qué tiendas puedo comprar y enviar con courier?', 'answer' => 'Puedes comprar en tiendas como Amazon, eBay, Apple, Sephora y Tommy Hilfiger, entre otras, e impulsamos especialmente el servicio USA - Perú.'],
                            ['question' => '¿Puedo agrupar varios paquetes en un solo envío?', 'answer' => 'Sí, ofrecemos consolidación de paquetes para optimizar tus costos y tiempos de entrega.'],
                            ['question' => '¿Cómo hago seguimiento de mi paquete?', 'answer' => 'Contamos con seguimiento en tiempo real para que conozcas el estado y ubicación de tu envío en todo momento.'],
                        ],
                    ],
                ],
            ],
        ];
    }
}
