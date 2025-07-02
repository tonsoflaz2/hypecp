@extends('shell')

@section('title', 'Demos - Hypermedia Copy & Paste')

@section('sidebar')
<div class="p-8 text-gray-500">
    <h2 class="text-xl font-bold text-black mb-4">Demos</h2>
    <p class="text-sm mb-6">
        Explore interactive examples showcasing various HTMX and Datastar techniques.
    </p>
    
    <div class="space-y-2">
        <a href="#featured" class="block hover:text-black">Featured Demos</a>
        <a href="#htmx" class="block hover:text-black">HTMX Examples</a>
        <a href="#datastar" class="block hover:text-black">Datastar Examples</a>
    </div>
</div>
@endsection

@section('main')
<div class="p-6 md:p-12 text-gray-500 max-w-full">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-black mb-4">Interactive Demos</h1>
        <p class="text-lg">
            Explore these interactive examples to see HTMX and Datastar in action. Each demo includes a video walkthrough and working code examples.
        </p>
    </div>

    <!-- Featured Section -->
    <section id="featured" class="mb-12">
        <h2 class="text-2xl font-bold text-black mb-6 border-b pb-2">Featured Demos</h2>
        <p class="mb-6 text-gray-600">
            Our most comprehensive examples with full video tutorials and complete implementations.
        </p>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h3 class="font-bold text-lg mb-2">
                    <a href="/demos/htmx-structure" class="text-blue-600 hover:text-blue-800">Htmx Structure</a>
                </h3>
                <p class="text-sm mb-3">Advanced HTMX patterns for complex UI interactions with inline editing and data relationships.</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h3 class="font-bold text-lg mb-2">
                    <a href="/demos/live-dashboard" class="text-blue-600 hover:text-blue-800">Htmx Dashboard</a>
                </h3>
                <p class="text-sm mb-3">A live dashboard demo with multiple widgets and out-of-band updates using HTMX.</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h3 class="font-bold text-lg mb-2">
                    <a href="/demos/datastar-signals" class="text-blue-600 hover:text-blue-800">Datastar Signals</a>
                </h3>
                <p class="text-sm mb-3">Signal-based reactivity and state management with interactive components and real-time updates.</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Datastar</span>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h3 class="font-bold text-lg mb-2">
                    <a href="/demos/live-dashboard" class="text-blue-600 hover:text-blue-800">hx-swap-oob</a>
                </h3>
                <p class="text-sm mb-3">Demonstrates <code>hx-swap-oob</code> for out-of-band updates in a live dashboard context.</p>
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                </div>
            </div>
        </div>
    </section>

    <!-- HTMX Examples Section -->
    <section id="htmx" class="mb-12">
        <h2 class="text-2xl font-bold text-black mb-6 border-b pb-2">HTMX Examples</h2>
        <p class="mb-6 text-gray-600">
            Form validation and interactive patterns using HTMX.
        </p>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b text-left text-xs font-bold text-gray-700 uppercase">Example</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-bold text-gray-700 uppercase">Attributes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4 border-b">
                            <a href="/demos/htmx-validation" class="text-blue-600 hover:text-blue-800 font-semibold">HTMX Form Validation</a>
                            <div class="text-xs text-gray-500">Server-side validation with HTMX for real-time feedback and error handling.</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-b align-top">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-post</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-trigger</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-target</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-swap</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 border-b">
                            <a href="/demos/htmx-structure" class="text-blue-600 hover:text-blue-800 font-semibold">Htmx Structure</a>
                            <div class="text-xs text-gray-500">Advanced HTMX patterns for complex UI interactions with inline editing and data relationships.</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-b align-top">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-get</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-trigger</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-target</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-swap</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 border-b">
                            <a href="/demos/live-dashboard" class="text-blue-600 hover:text-blue-800 font-semibold">Htmx Dashboard</a>
                            <div class="text-xs text-gray-500">A live dashboard demo with multiple widgets and out-of-band updates using HTMX.</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-b align-top">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-get</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-swap-oob</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-trigger</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 border-b">
                            <a href="/demos/live-dashboard" class="text-blue-600 hover:text-blue-800 font-semibold">hx-swap-oob</a>
                            <div class="text-xs text-gray-500">Demonstrates <code>hx-swap-oob</code> for out-of-band updates in a live dashboard context.</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">HTMX</span>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-b align-top">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-get</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-swap-oob</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hx-trigger</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Datastar Examples Section -->
    <section id="datastar" class="mb-12">
        <h2 class="text-2xl font-bold text-black mb-6 border-b pb-2">Datastar Examples</h2>
        <p class="mb-6 text-gray-600">
            Real-time data streaming and reactive UI updates using Datastar.
        </p>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b text-left text-xs font-bold text-gray-700 uppercase">Example</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-bold text-gray-700 uppercase">Attributes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4 border-b">
                            <a href="/demos/datastar-signals" class="text-blue-600 hover:text-blue-800 font-semibold">Datastar Signals</a>
                            <div class="text-xs text-gray-500">Signal-based reactivity and state management with interactive components and real-time updates.</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Datastar</span>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Video</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-b align-top">
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">datastar</span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">signals</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-black mb-6 border-b pb-2">Coming Soon</h2>
        <p class="mb-6 text-gray-600">
            More demos are in development. Follow our progress on YouTube for new releases.
        </p>
        
        <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300">
            <div class="text-center">
                <h3 class="font-bold text-lg mb-2 text-gray-600">More Demos Coming</h3>
                <p class="text-sm text-gray-500 mb-4">
                    We're working on more interactive examples including advanced HTMX patterns, 
                    more Datastar integrations, and comprehensive tutorials.
                </p>
                <a href="https://youtube.com/@hypermedia-tv" 
                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                    Subscribe to Hypermedia TV
                </a>
            </div>
        </div>
    </section>
</div>
@endsection 