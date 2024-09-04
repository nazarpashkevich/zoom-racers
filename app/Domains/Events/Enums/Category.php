<?php

namespace App\Domains\Events\Enums;

use App\Domains\Common\Traits\Enum\ApiDictionarible;

enum Category: string
{
    use ApiDictionarible;

    case TechnologyIt = 'technology_it';
    case MarketingAdvertising = 'marketing_advertising';
    case FinanceInvestment = 'finance_investment';
    case EducationTraining = 'education_training';
    case HealthcareMedicine = 'healthcare_medicine';
    case LeadershipManagement = 'leadership_management';
    case SalesCrm = 'sales_crm';
    case HumanResourcesRecruitment = 'human_resources_recruitment';
    case PersonalDevelopmentCoaching = 'personal_development_coaching';
    case EnvironmentalSustainability = 'environmental_sustainability';
    case ArtDesign = 'art_design';
    case ScienceResearch = 'science_research';
    case LawLegal = 'law_legal';
    case BusinessNetworking = 'business_networking';
    case InnovationStartups = 'innovation_startups';
    case Other = 'other';
}
