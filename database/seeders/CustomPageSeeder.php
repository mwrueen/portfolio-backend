<?php

namespace Database\Seeders;

use App\Models\CustomPage;
use Illuminate\Database\Seeder;

class CustomPageSeeder extends Seeder
{
    public function run(): void
    {
        CustomPage::firstOrCreate(
            ['slug' => 'about-me'],
            [
                'title' => 'About Md Mehedi Hasan Rueen',
                'summary' => 'Background, technical philosophy, and engineering leadership journey of Md Mehedi Hasan Rueen.',
                'content' => "### Executive Profile\n\nI am **Md Mehedi Hasan Rueen**, a Lead Software Engineer & Systems Architect specializing in distributed high-throughput applications, cloud-native backend systems, and modern interactive frontends.\n\n### Core Engineering Philosophy\n\n1. **High Concurrency & Low Latency**: Building systems using event-driven architectures, Go/Rust microservices, and high-performance Laravel/Node.js engines.\n2. **Clean Relational & Cache Modeling**: Designing normalized PostgreSQL 16 architectures combined with Redis for sub-millisecond data retrieval.\n3. **Production Reliability**: Adhering to 99.99% availability targets, idempotent API design, and comprehensive automated observability.\n\n### Career Highlights\n\n- Spearheaded architecture for message streaming brokers capable of handling 50k+ events/sec.\n- Designed stateless REST APIs and Next.js App Router platforms serving mission-critical user workflows.\n- Mentored agile engineering teams across backend, DevOps, and cloud deployment pipelines.\n\nFeel free to explore my showcased projects or get in touch for architecture consulting and lead engineering roles.",
                'show_in_menu' => true,
                'order_index' => 1,
                'is_published' => true,
                'meta_title' => 'About Me - Md Mehedi Hasan Rueen',
                'meta_description' => 'Learn more about Md Mehedi Hasan Rueen, Lead Software Engineer and Systems Architect.',
            ]
        );

        CustomPage::firstOrCreate(
            ['slug' => 'consulting-and-services'],
            [
                'title' => 'Architecture Consulting & Services',
                'summary' => 'Specialized advisory services covering microservices architecture, API scalability audits, and database optimization.',
                'content' => "### Systems Advisory & Consulting\n\nIn addition to full-time engineering leadership, I provide advisory consulting for startups and scale-ups needing battle-tested architectural guidance.\n\n#### Key Service Areas:\n\n- **Microservices & Distributed Systems Audits**: Deconstructing monolithic applications into performant, loosely coupled services.\n- **Database Performance Tuning**: PostgreSQL index optimization, query execution plan analysis, and Redis caching strategies.\n- **API Gateway & Zero-Trust Security**: Token bucket rate-limiting, OAuth2/Sanctum authentication pipelines, and DDoS mitigation.\n- **Full-Stack Engineering with Next.js & Laravel**: Best practices in modern server-side rendering, SEO, and robust backend integrations.\n\n#### Engagement Model:\n\nAvailable for advisory retainers, architecture design sprints, and technical due diligence reviews. Direct inquiries can be scheduled via my contact channels.",
                'show_in_menu' => false,
                'order_index' => 2,
                'is_published' => true,
                'meta_title' => 'Consulting Services - Md Mehedi Hasan Rueen',
                'meta_description' => 'Architecture consulting and scalability audits by Md Mehedi Hasan Rueen.',
            ]
        );
    }
}
