<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            'Politics', 'Business', 'Sports',
            'Technology', 'Entertainment', 'Lifestyle',
        ])->mapWithKeys(fn (string $name) => [$name => Category::create(['name' => $name])]);

        // 20 sample articles
        foreach ($this->articles() as $item) {
            Article::factory()->create([
                'category_id' => $categories[$item['category']]->id,
                'title' => $item['title'],
                'summary' => $item['summary'],
                'body' => $item['body'],
                'permalink' => Str::slug($item['title']),
            ]);
        }

        // A few drafts and hides from public
        Article::factory(2)->draft()->recycle($categories->values())->create();
    }

    private function articles(): array
    {
        return [
            // Politics
            [
                'category' => 'Politics',
                'title' => 'Lawmakers prepare for budget season with focus on cost of living',
                'summary' => 'Cost-of-living concerns are expected to shape this year\'s budget debates as households and businesses look for relief.',
                'body' => "Ahead of the next budget cycle, lawmakers from across the aisle are signalling that everyday expenses will dominate the discussion. Food prices, transport costs and housing remain top of mind for many families.\n\nAnalysts say the debate will test how far targeted assistance can go without straining public finances. Citizens are encouraged to follow the proceedings and submit feedback through official channels.",
            ],
            [
                'category' => 'Politics',
                'title' => 'State governments urged to speed up flood preparedness funding',
                'summary' => 'With the monsoon season under way, officials are calling for early release of funds for drainage upgrades and relief centres.',
                'body' => "Community leaders in several states are asking for faster approval of flood mitigation projects before the heaviest rains arrive. Early funding, they say, allows drainage works and evacuation centres to be ready in time.\n\nDisaster management agencies have reminded residents in low-lying areas to prepare emergency kits and keep important documents in waterproof containers.",
            ],
            [
                'category' => 'Politics',
                'title' => 'Public consultation opens on proposed digital government services portal',
                'summary' => 'Citizens can share feedback on a planned one-stop portal that would bring licences, permits and payments online.',
                'body' => "A public consultation has opened for a proposed portal that would let residents handle common government transactions in one place. Planners hope to reduce counter visits and shorten processing times.\n\nFeedback is being collected on usability, data privacy and support for those with limited internet access. Organisers say the input will guide the first phase of the rollout.",
            ],

            // Business
            [
                'category' => 'Business',
                'title' => 'Ringgit steadies as investors weigh regional growth outlook',
                'summary' => 'Currency traders are watching regional data and commodity prices as the ringgit holds within a narrow range.',
                'body' => "The ringgit traded within a tight band this week as investors balanced mixed signals from regional economies. Commodity prices and external demand continue to influence sentiment.\n\nEconomists note that steady domestic consumption provides a cushion, though they caution that global uncertainty could still trigger short-term swings.",
            ],
            [
                'category' => 'Business',
                'title' => 'Small businesses embrace QR payments across night markets',
                'summary' => 'From satay stalls to fruit vendors, traders say cashless options are bringing in new customers and faster queues.',
                'body' => "Walk through any busy pasar malam and you are likely to spot a QR code taped beside the cash box. Traders say digital payments are speeding up service and attracting younger shoppers who rarely carry cash.\n\nSome vendors still prefer notes and coins, but many report that offering both options has helped their evening sales.",
            ],
            [
                'category' => 'Business',
                'title' => 'Klang Valley office rents hold steady as hybrid work settles in',
                'summary' => 'Property consultants say tenants are choosing flexible layouts and shorter leases as hybrid arrangements become the norm.',
                'body' => "Office rents in the Klang Valley have remained largely stable as companies rethink how much space they need. Many tenants now favour flexible floor plans, shared meeting areas and shorter lease terms.\n\nBuilding owners are responding with upgraded facilities and better connectivity, hoping to draw staff back to the workplace a few days a week.",
            ],
            [
                'category' => 'Business',
                'title' => 'Palm oil exporters watch weather patterns as year-end demand builds',
                'summary' => 'Planters and traders are tracking rainfall and shipping schedules ahead of the traditional year-end buying season.',
                'body' => "Producers and exporters are keeping a close eye on weather conditions that affect harvests and logistics. Heavy rain can slow plantation work and delay transport to ports.\n\nTraders expect demand to pick up toward the end of the year, and many are planning shipments early to avoid congestion at major terminals.",
            ],

            // Sports
            [
                'category' => 'Sports',
                'title' => 'National shuttlers step up training ahead of busy badminton calendar',
                'summary' => 'Coaches are fine-tuning fitness and match strategy as players prepare for a packed run of international tournaments.',
                'body' => "Training camps have intensified for the national badminton squad, with coaches focusing on stamina, court movement and tactical variety. Players say the schedule ahead is demanding but exciting.\n\nSupport staff are also paying attention to recovery and injury prevention, knowing that consistency across multiple tournaments will be key.",
            ],
            [
                'category' => 'Sports',
                'title' => 'Grassroots football programme expands to more rural districts',
                'summary' => 'Weekend coaching clinics are giving children in smaller towns a chance to learn the basics and play organised matches.',
                'body' => "A community football initiative is extending its weekend clinics to additional rural districts, bringing qualified coaches and proper equipment to young players. Parents say the sessions are keeping children active and engaged.\n\nOrganisers hope the programme will uncover new talent and give local clubs a stronger pipeline of players.",
            ],
            [
                'category' => 'Sports',
                'title' => 'Weekend marathon draws thousands of runners to the city centre',
                'summary' => 'Road closures and cheering crowds marked a lively morning as participants of all ages took on 5km to full-distance routes.',
                'body' => "Thousands of runners lined up at dawn for a city marathon that offered routes for every fitness level. Volunteers handed out water at regular stations while supporters cheered along the course.\n\nMany participants ran for charity, and organisers said the turnout reflects a growing interest in running as a social and healthy pastime.",
            ],
            [
                'category' => 'Sports',
                'title' => 'Young cyclists gear up as velodrome season approaches',
                'summary' => 'Junior riders are logging extra hours on the track, hoping to impress selectors before the new competition season.',
                'body' => "Junior track cyclists are putting in long sessions at the velodrome as the new season draws near. Coaches are working on starting technique, pacing and team coordination.\n\nFor many of the riders, the goal is a place in the development squad, which offers access to better training facilities and overseas exposure.",
            ],

            // Technology
            [
                'category' => 'Technology',
                'title' => 'Local startups explore AI tools to speed up customer support',
                'summary' => 'Young companies are testing chat assistants and automated ticket sorting to respond to customers faster.',
                'body' => "A growing number of local startups are trialling AI-powered tools to handle routine customer questions. Founders say automated replies free their teams to focus on complex cases.\n\nThey also stress the need for human oversight, particularly when it comes to accuracy and protecting customer data.",
            ],
            [
                'category' => 'Technology',
                'title' => 'Cybersecurity awareness drive targets online scam prevention',
                'summary' => 'A nationwide campaign is teaching the public how to spot phishing messages, fake links and suspicious calls.',
                'body' => "Authorities and industry groups have launched an awareness campaign to help the public recognise common online scams. Tips include checking sender details, avoiding unknown links and never sharing one-time passwords.\n\nWorkshops are being held at community centres and schools, with special attention given to senior citizens who are often targeted.",
            ],
            [
                'category' => 'Technology',
                'title' => 'Co-working hubs in Penang attract growing community of developers',
                'summary' => 'Freelancers and small teams are gathering at shared spaces for meetups, mentoring sessions and weekend hackathons.',
                'body' => "Co-working spaces in Penang are becoming meeting points for developers, designers and founders. Regular meetups and hackathons help newcomers connect with experienced mentors.\n\nSpace operators say demand is strongest for flexible memberships, and they plan to add more event areas and quiet zones for focused work.",
            ],

            // Entertainment
            [
                'category' => 'Entertainment',
                'title' => 'Independent filmmakers showcase new short films at weekend festival',
                'summary' => 'Audiences packed a small cinema to watch locally made shorts covering family, identity and everyday city life.',
                'body' => "A weekend festival gave independent filmmakers a stage for their latest short films. The screenings covered themes such as family bonds, changing neighbourhoods and the pressures of modern work.\n\nQuestion-and-answer sessions after each film let audiences talk directly to directors, many of whom are working with very small budgets.",
            ],
            [
                'category' => 'Entertainment',
                'title' => 'Night markets and live music bring new life to heritage streets',
                'summary' => 'Weekend events are encouraging visitors to explore old shophouses, street food and local performers.',
                'body' => "Heritage streets in the old town are buzzing on weekends thanks to a series of night markets and live performances. Visitors browse handmade crafts, taste street food and enjoy music from emerging local artists.\n\nShop owners say the extra foot traffic has helped keep traditional trades alive.",
            ],
            [
                'category' => 'Entertainment',
                'title' => 'Local streaming series gains fans with multilingual storytelling',
                'summary' => 'Viewers are praising a new drama that blends Malay, English, Mandarin and Tamil in everyday conversations.',
                'body' => "A new locally produced series is winning attention for the way its characters switch naturally between languages, just as many Malaysians do in daily life. Viewers say it feels authentic and relatable.\n\nThe production team says they wanted to reflect the country's diversity without making it feel forced, and early reviews suggest the approach is working.",
            ],

            // Lifestyle
            [
                'category' => 'Lifestyle',
                'title' => 'Home cooks revisit traditional kuih recipes with modern twists',
                'summary' => 'Social media is inspiring a new wave of bakers to experiment with classic Malaysian sweets and fresh flavours.',
                'body' => "Traditional kuih are enjoying a revival as home cooks share recipes and techniques online. Some stay faithful to grandmothers' methods, while others add ingredients such as dark chocolate or matcha.\n\nCooking instructors say the trend is helping younger generations connect with their heritage through food.",
            ],
            [
                'category' => 'Lifestyle',
                'title' => 'Weekend getaways: quiet highland trails gain popularity',
                'summary' => 'Hikers and families are heading to cooler highland routes for fresh air, tea plantations and scenic viewpoints.',
                'body' => "Highland trails are attracting more weekend visitors looking to escape the heat of the city. Popular activities include short hikes, picnics and visits to tea plantations.\n\nLocal guides remind visitors to check weather conditions, carry enough water and take their rubbish with them to keep the trails clean.",
            ],
            [
                'category' => 'Lifestyle',
                'title' => 'Urban gardening picks up as residents turn balconies into green spaces',
                'summary' => 'Apartment dwellers are growing herbs, chillies and leafy greens in small containers and vertical planters.',
                'body' => "Even without a backyard, many city residents are growing their own food. Balconies are filling up with pots of herbs, chillies and vegetables that thrive in the tropical climate.\n\nGardening groups share tips on composting and pest control, and say the hobby is a simple way to reduce food waste and relax after work.",
            ],
        ];
    }
}