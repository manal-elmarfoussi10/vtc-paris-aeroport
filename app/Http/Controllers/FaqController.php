<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class FaqController extends Controller
{
    public function index()
    {
        // Get FAQ data from settings (could be stored as JSON)
        $faqData = Setting::get('faq_json');
        $faqs = $faqData ? json_decode($faqData, true) : $this->getDefaultFaqs();

        return view('faq.index', compact('faqs'));
    }

    /**
     * Default FAQ data if not set in settings
     */
    private function getDefaultFaqs(): array
    {
        return [
            [
                'question' => 'Comment réserver un VTC ?',
                'answer' => 'Vous pouvez réserver directement en ligne via notre site web. Remplissez le formulaire avec vos adresses de départ et d\'arrivée, la date et l\'heure souhaitées, ainsi que le nombre de passagers et bagages. Nous vous confirmons instantanément.',
            ],
            [
                'question' => 'Quels sont les délais de réservation ?',
                'answer' => 'Les réservations doivent être faites au minimum 2 heures à l\'avance. Pour les transferts aéroport, nous recommandons de réserver 24 à 48 heures à l\'avance.',
            ],
            [
                'question' => 'Quels sont vos tarifs ?',
                'answer' => 'Nos tarifs sont fixes et transparents. Ils dépendent de la distance, de la durée du trajet et du type de véhicule choisi. Vous recevez une estimation précise avant confirmation.',
            ],
            [
                'question' => 'Acceptez-vous les paiements par carte ?',
                'answer' => 'Oui, nous acceptons les paiements par carte bancaire Visa, MasterCard et American Express. Le paiement est sécurisé et s\'effectue en ligne.',
            ],
            [
                'question' => 'Puis-je annuler ma réservation ?',
                'answer' => 'L\'annulation est gratuite jusqu\'à 24 heures avant le départ. Au-delà, des frais d\'annulation peuvent s\'appliquer selon nos conditions générales.',
            ],
            [
                'question' => 'Les chauffeurs parlent-ils français ?',
                'answer' => 'Tous nos chauffeurs sont francophones et professionnels. Ils connaissent parfaitement Paris et ses environs, ainsi que les aéroports.',
            ],
            [
                'question' => 'Proposez-vous des services supplémentaires ?',
                'answer' => 'Oui : accueil à l\'aéroport avec panneau nominatif, sièges enfant, véhicules adaptés aux personnes à mobilité réduite, et service VIP disponible.',
            ],
            [
                'question' => 'Que faire en cas de retard de vol ?',
                'answer' => 'Contactez-nous immédiatement au numéro indiqué sur votre confirmation. Nous ajustons votre prise en charge sans frais supplémentaires.',
            ],
            [
                'question' => 'Les véhicules sont-ils climatisés ?',
                'answer' => 'Oui, tous nos véhicules sont climatisés et entretenus régulièrement pour votre confort.',
            ],
            [
                'question' => 'Puis-je transporter des animaux ?',
                'answer' => 'Les animaux de petite taille en cage de transport sont acceptés. Les chiens doivent être tenus en laisse. Prévenez-nous à l\'avance.',
            ],
        ];
    }
}
