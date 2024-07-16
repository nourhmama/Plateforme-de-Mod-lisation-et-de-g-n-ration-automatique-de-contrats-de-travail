<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleContrat;

class ArticleContratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $articles = [
            [
                'title' => 'Engagement et attribution de fonctions',
                'content' => "L’employeur engage l’employée susnommée qui accepte de travailler, à compter du [DATE_EMBAUCHE] en tant que [POSTE]"
            ],
            [
                'title' => 'Exclusivité',
                'content' => "L’employée déclare être libre de tout engagement professionnel, qu’elle n’est liée à aucun autre employeur et avoir quitté son précédent emploi libre de tout engagement ; toute fausse déclaration sur ce point pouvant entraîner la résiliation de plein droit du présent contrat, si bon semble à l’employeur. L’employée s’engage à fournir ses services d’une façon exclusive à l’employeur."
            ],
            [
                'title' => 'Obligation de l’employée',
                'content' => "L’employée s’engage pendant toute la durée de sa relation de travail à respecter ses obligations découlant de la loi et des règlements et spécialement : - Consacrer tout son temps au service où il est affecté, suivant l’horaire établi par la direction de la société, - Se conformer aux instructions qui lui seront données par les personnes sous les ordres desquelles elle est placée, - Observer le secret professionnel, notamment, s’interdire toute communication écrite ou verbale et quelconque information relative à l’organisation de la société, ses clients, ses partenaires et généralement toute question ayant trait à l’activité de la société de près ou de loin, sauf autorisation donnée par son directeur général, - Avoir une conduite morale (langage, comportement et actes) et une tenue vestimentaires correctes, aussi bien vis-à-vis des clients, de ses supérieurs et des partenaires qu’à l’égard de ses collègues, - Et, d’une façon générale, respecter toutes les obligations découlant du règlement intérieur et de la charte d’éthique professionnelle adoptée par la société."
            ],
            [
                'title' => 'Période d’essai et préavis',
                'content' => "Le présent contrat ne deviendra ferme et définitif, qu’à l’expiration d’une période d’essai de trois mois de travail effectif, au cours de laquelle chacune des deux parties aura la faculté réciproque de rompre cette relation contractuelle sans prévis ni indemnité. Au-delà de la période d’essai, le présent contrat pourra être rompu à tout moment par l’une ou l’autre des parties, sous réserve de respecter les dispositions légales en vigueur. En particulier en cas de démission du salarié, une période de préavis de 3 mois sera applicable."
            ],
            [
                'title' => 'Durée du contrat',
                'content' => "Mme [NOM_EMPLOYE] est engagée à partir [DATE_EMBAUCHE] pour une [DUREE_CONTRAT]. Ce contrat sera renouvelé à son échéance dans le respect de la législation du travail en vigueur."
            ],
            [
                'title' => 'Lieu de travail',
                'content' => "Le lieu de travail est situé à [LIEU_TRAVAIL] au siège de la société [ADRESSE_SIEGE_SOCIAL]."
            ],
            [
                'title' => 'Rémunération',
                'content' => "Mme [NOM_EMPLOYE] recevra au commencement de son contrat en contrepartie de ses fonctions un salaire net mensuel de [SALAIRE] dinars tunisiens. Les modalités de paiement dudit salaire et les différents avantages et rémunérations seront fixées par la société après avoir procédé au prélèvement légal des retenues. Le tout sera indiqué avec précision sur les fiches de paie délivrées par la société. Des révisions de salaire ultérieures pourront être faites selon les usages internes au sein de l’entreprise."
            ],
            [
                'title' => 'Horaire de travail',
                'content' => "[NOM_ENTREPRISE] est soumise au régime [REGIME_HEBDOMADAIRE] par semaine. En pratique, les heures de travail seront réparties sur une base de [BASE_HEBDOMADAIRE] par semaine. Cependant, lorsque la charge des travaux demande de fournir plus que [BASE_HEBDOMADAIRE] par semaine, l’employée est tenue à respecter le régime auquel [NOM_ENTREPRISE] est soumise en termes de temps de présence. Les horaires de travail sont comme suit : Pour l’hiver La journée de travail débute entre [HEURE_DEBUT_HIVER] La pause déjeuner, de [DUREE_PAUSE_DEJEUNER_HIVER], est à prendre entre [HEURE_DEBUT_PAUSE_DEJEUNER_HIVER] et [HEURE_FIN_PAUSE_DEJEUNER_HIVER] La journée de travail est de [DUREE_TRAVAIL_EFFECTIF_HIVER] heures de travail effectives, hors pauses Pour l’été (juillet et août) La journée de travail débute entre [HEURE_DEBUT_ETE] Une pause de [DUREE_PAUSE_ETE] entre [HEURE_DEBUT_PAUSE_ETE] et [HEURE_FIN_PAUSE_ETE]. La journée de travail est de [DUREE_TRAVAIL_EFFECTIF_ETE] heures de travail effectives, hors pauses"
            ],
            [
                'title' => 'Congés payés',
                'content' => "Il est convenu que Mme [NOM_EMPLOYE] aura droit chaque année à [NB_JOURS_CONGES] jours calendaires de congés payés, cette période étant déterminée par accord entre la société et [NOM_EMPLOYE]."
            ],
            [
                'title' => 'Affiliation obligatoire à la CNSS',
                'content' => "Dès son entrée au service, l’employée sera affiliée au régime légal et obligatoire de la CNSS et couvert contre les accidents de travail."
            ],
            [
                'title' => 'Résiliation du contrat',
                'content' => "Le présent contrat peut être résilié par consentement mutuel. Les deux parties (employeur et
                employée) conviendront ensemble dans ce cas des dispositions de préavis relatif à cette
                résiliation. Il peut aussi être résilié par décision de l’employeur après échange avec
                l’employée sur ses motivations pour l’une quelconque des raisons prévues par la
                règlementation en vigueur ou pour l’un des motifs suivants :
                - Faute lourde, insuffisance professionnelle constatée par l’employeur, indiscipline
                caractérisée, refus d’obéir aux instructions données ou d’accomplir le travail confié,
                absence non justifiée pour une durée égale ou supérieure à trois jours suivie d’une
                mise en demeure demeurée sans reprise du travail dans les 48 heures qui suivent,
                - Divulgation du secret professionnel,
                - Etat d’ébriété pendant les heures de services,
                - En cas de force majeure ou de survenance de circonstances particulières rendant
                impossible l’exécution du présent contrat.
                Dans ces cas, l’employée ne peut prétendre à aucun préavis ou indemnité. La résiliation est
                décidée sans préjudice pour l’employeur de réclamer des dommages et intérêts dus par
                l’employée."
            ],
            [
                'title' => 'Election de domicile',
                'content' => " Au vu du présent contrat, l’employeur fait élection de domicile en son siège social.
                L’employée fait élection de domicile en sa demeure telle qu’indiquée ci-dessus ou à toute
                adresse qui doit être notifié à l’employeur par écrit contre décharge du service chargé du
                personnel ou par lettre recommandée avec accusé de réception.
                "
            ],
            [
                'title' => 'Mobilité',
                'content' => "Le lieu de travail de l’employé est actuellement fixé à [LIEU_TRAVAIL] et il pourra être modifié par la société,temporairement ou de manière permanente, pour des impératifs liés à l’activité, à l’organisation et au bon fonctionnement de l’entreprise. L’employée pourra donc être amenée à exercer ses fonctions en tout lieu du territoire national."
            ],
            [
                'title' => 'Confidentialité',
                'content' => "Mme [NOM_EMPLOYE] s’engage à respecter, tant au cours de l’exécution du contrat qu’après sa rupture, quelle qu’en soit la cause, le secret professionnel le plus absolu sur tous les projets, études, travaux, réalisations dans l’entreprise, soit pour le compte de clients de l’entreprise, soit pour l’entreprise elle-même, ainsi que sur toutes les informations techniques, financières, commerciales ou de gestion. Mme [NOM_EMPLOYE] sera, en outre, tenue à une obligation de discrétion absolue à l’intérieur de la société sur l’ensemble des informations confidentielles et des renseignements dont elle peut avoir connaissance dans le cadre de ses fonctions."
            ],
            [
                'title' => 'Attribution des compétences',
                'content' => "Toute contestation relative à l’interprétation, l’exécution ou l’inexécution du présent contrat de travail sera du ressort exclusif des tribunaux de [VILLE_JURIDICTION]."
            ],
        ];

        foreach ($articles as $article) {
            ArticleContrat::create([
                'title' => $article['title'],
                'content' => $article['content'],
            ]);
        }
    }
}
