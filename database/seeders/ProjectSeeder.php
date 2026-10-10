<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TechStack;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Tech Stacks
        $stacksData = [
            ['name' => 'Laravel 11', 'slug' => 'laravel', 'category' => 'Backend', 'icon_name' => 'Server', 'color' => '#FF2D20'],
            ['name' => 'Next.js 15', 'slug' => 'nextjs', 'category' => 'Frontend', 'icon_name' => 'Globe', 'color' => '#000000'],
            ['name' => 'Node.js', 'slug' => 'nodejs', 'category' => 'Backend', 'icon_name' => 'Terminal', 'color' => '#339933'],
            ['name' => 'React.js', 'slug' => 'react', 'category' => 'Frontend', 'icon_name' => 'Code2', 'color' => '#00D8FF'],
            ['name' => 'TypeScript', 'slug' => 'typescript', 'category' => 'Frontend', 'icon_name' => 'Code2', 'color' => '#3178C6'],
            ['name' => 'PostgreSQL 18', 'slug' => 'postgresql', 'category' => 'Database', 'icon_name' => 'Database', 'color' => '#4169E1'],
            ['name' => 'Redis', 'slug' => 'redis', 'category' => 'Database', 'icon_name' => 'Zap', 'color' => '#DC382D'],
            ['name' => 'Go / Golang', 'slug' => 'go', 'category' => 'Backend', 'icon_name' => 'Cpu', 'color' => '#00ADD8'],
            ['name' => 'Docker & K8s', 'slug' => 'docker', 'category' => 'DevOps', 'icon_name' => 'Container', 'color' => '#2496ED'],
            ['name' => 'Tailwind CSS', 'slug' => 'tailwindcss', 'category' => 'Frontend', 'icon_name' => 'Palette', 'color' => '#06B6D4'],
            ['name' => 'Python / AI', 'slug' => 'python', 'category' => 'AI/ML', 'icon_name' => 'Terminal', 'color' => '#3776AB'],
        ];

        $stackModels = [];
        foreach ($stacksData as $data) {
            $stackModels[$data['slug']] = TechStack::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // 2. Seed Projects
        $projectsData = [
            [
                'title' => 'NexusMQ - High-Throughput Event Streaming Broker',
                'slug' => 'nexusmq-distributed-message-queue',
                'tagline' => 'Low-latency distributed event stream broker processing 50k+ events/sec with zero message loss.',
                'summary' => 'Engineered a high-concurrency event stream engine utilizing Raft consensus for leader election and append-only WAL for crash resilience.',
                'description' => "## NexusMQ Architecture Overview\n\nNexusMQ is a custom distributed message queue engineered to address low-latency real-time data ingest pipelines. Built with Go, Node.js, and backed by PostgreSQL 18 & Redis for persistence metadata.",
                'cover_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80',
                'demo_url' => 'https://nexusmq.demo.dev',
                'github_url' => 'https://github.com/mwrueen/nexusmq-broker',
                'architecture_notes' => 'Event-Driven Distributed Microservices Architecture with Raft Consensus & TCP Zero-Copy IO.',
                'features' => [
                    'Distributed Partition Raft Replication',
                    'Zero-Copy Direct Disk-to-Socket Streaming',
                    'Real-Time Prometheus & Grafana Metric Exporter',
                    'At-Least-Once & Exactly-Once Delivery Guarantees',
                ],
                'metrics' => [
                    'RPS' => '54,000+',
                    'P99 Latency' => '1.2ms',
                    'Uptime' => '99.999%',
                ],
                'is_featured' => true,
                'order_index' => 1,
                'status' => 'published',
                'stacks' => ['laravel', 'nextjs', 'nodejs', 'react', 'postgresql', 'redis'],
            ],
            [
                'title' => 'AuraScale - AI Automated Code Review & Audit Platform',
                'slug' => 'aurascale-ai-code-auditor',
                'tagline' => 'Intelligent GitHub App providing automated security static analysis and AI-driven pull-request refactoring.',
                'summary' => 'Built a full-stack SaaS platform integrating AST code parsing with fine-tuned LLMs to detect memory leaks and OWASP security flaws in PRs.',
                'description' => "## AuraScale System Design\n\nAuraScale automates code quality governance for enterprise engineering teams. Powered by Laravel 11, Node.js, React, Next.js 15, and PostgreSQL 18.",
                'cover_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80',
                'demo_url' => 'https://aurascale.io',
                'github_url' => 'https://github.com/mwrueen/aurascale-platform',
                'architecture_notes' => 'Microservices Architecture with Asynchronous Redis Event Queue & Vector Database Embeddings.',
                'features' => [
                    'Automated OWASP Top 10 Vulnerability Scanner',
                    'AI-Powered Code Refactoring & Unit Test Generator',
                    'Real-Time WebSocket Pull Request Review Dashboard',
                ],
                'metrics' => [
                    'PR Review Time' => '< 12s',
                    'Accuracy' => '98.4%',
                ],
                'is_featured' => true,
                'order_index' => 2,
                'status' => 'published',
                'stacks' => ['laravel', 'nextjs', 'nodejs', 'react', 'postgresql', 'redis', 'tailwindcss'],
            ],
            [
                'title' => 'Hyperflow - Real-Time Financial Market Analytics Engine',
                'slug' => 'hyperflow-financial-analytics-engine',
                'tagline' => 'Sub-millisecond order book visualizer & algorithmic trade signal processor with WebGL rendering.',
                'summary' => 'Developed a high-frequency market data dashboard rendering 100k data points at 60 FPS using React, Next.js, Node.js WebSockets, and Redis Pub/Sub.',
                'description' => "## Hyperflow Architecture\n\nHyperflow captures real-time tick data from global exchanges via WebSocket multiplexing. Powered by React, Next.js, Node.js, and PostgreSQL 18 & Redis.",
                'cover_image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=1200&q=80',
                'demo_url' => 'https://hyperflow.trade',
                'github_url' => 'https://github.com/mwrueen/hyperflow-trading',
                'architecture_notes' => 'Event-Driven Real-Time WebSocket Streaming with WebGL Rendering Engine.',
                'features' => [
                    '60 FPS Canvas Rendering for 100k Technical Data Points',
                    'Sub-Millisecond Order Book Depth Visualizer',
                    'Custom Technical Indicator Calculation Engine',
                ],
                'metrics' => [
                    'Frame Rate' => '60 FPS',
                    'Latency' => '< 0.8ms',
                ],
                'is_featured' => true,
                'order_index' => 3,
                'status' => 'published',
                'stacks' => ['react', 'nextjs', 'nodejs', 'postgresql', 'redis', 'tailwindcss'],
            ],
            [
                'title' => 'CloudShield - Zero-Trust API Gateway & Security Firewall',
                'slug' => 'cloudshield-zero-trust-api-gateway',
                'tagline' => 'Enterprise API gateway with token bucket rate-limiting, dynamic IP filtering, and OpenAPI validation.',
                'summary' => 'Architected a robust reverse-proxy firewall API service with granular rate limits, JWT validation, and live security telemetry.',
                'description' => "## CloudShield Security Engine\n\nCloudShield sits in front of core enterprise services to enforce strict Zero-Trust access control policies. Powered by Laravel 11 API endpoints, Node.js microservices, and PostgreSQL 18 audit tables.",
                'cover_image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80',
                'demo_url' => 'https://cloudshield.dev',
                'github_url' => 'https://github.com/mwrueen/cloudshield-gateway',
                'architecture_notes' => 'Zero-Trust Architecture with Token-Bucket Throttling & Automated OpenAPI Schema Enforcement.',
                'features' => [
                    'Distributed Token Bucket & Sliding Window Rate Limiting',
                    'Dynamic IP Whitelisting & Threat Intelligence Sync',
                ],
                'metrics' => [
                    'Throughput' => '30k req/sec',
                    'Overhead' => '0.4ms',
                ],
                'is_featured' => false,
                'order_index' => 4,
                'status' => 'published',
                'stacks' => ['laravel', 'nodejs', 'postgresql', 'redis', 'docker'],
            ],
        ];

        foreach ($projectsData as $pData) {
            $stacks = $pData['stacks'];
            unset($pData['stacks']);

            $project = Project::updateOrCreate(['slug' => $pData['slug']], $pData);

            $stackIds = [];
            foreach ($stacks as $sSlug) {
                if (isset($stackModels[$sSlug])) {
                    $stackIds[] = $stackModels[$sSlug]->id;
                }
            }
            $project->techStacks()->sync($stackIds);
        }
    }
}
