@extends('layouts.public')

@section('content')
    <x-page-hero 
        title="Contact Us"
        subtitle="Get in touch with our team for inquiries, quotes, or support"
        :breadcrumbs="[['label' => 'Contact']]"
    />

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-12">
                {{-- Contact Info --}}
                <div 
                    x-data="{ shown: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                    class="lg:col-span-1 transition-all duration-700 ease-out"
                >
                    <h2 class="text-2xl font-bold text-foreground mb-6 font-display">Get In Touch</h2>
                    <p class="text-muted-foreground mb-8">
                        Have questions about our products or services? Our team is here to help. 
                        Reach out through any of the channels below.
                    </p>

                    <div class="space-y-6">
                        @php
                            $contactInfo = [
                                ['icon' => 'phone', 'label' => 'Phone', 'value' => $generalData['contact_phone'] ?? '', 'href' => 'tel:' . ($generalData['contact_phone'] ?? '')],
                                ['icon' => 'mail', 'label' => 'Email', 'value' => $generalData['contact_email'] ?? '', 'href' => 'mailto:' . ($generalData['contact_email'] ?? '')],
                                ['icon' => 'map-pin', 'label' => 'Address', 'value' => $generalData['address'] ?? '', 'href' => '#'],
                                ['icon' => 'clock', 'label' => 'Hours', 'value' => 'Sun-Fri: 9AM - 6PM', 'href' => '#'],
                            ];
                        @endphp

                        @foreach($contactInfo as $index => $info)
                            <a 
                                href="{{ $info['href'] }}"
                                x-data="{ shown: false }"
                                x-intersect.once="shown = true"
                                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                                class="flex items-start gap-4 p-4 bg-muted/50 rounded-xl hover:bg-muted transition-colors group"
                                style="transition-delay: {{ $index * 100 }}ms"
                            >
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center group-hover:bg-primary transition-colors">
                                    @if($info['icon'] === 'phone')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary group-hover:text-primary-foreground transition-colors"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    @elseif($info['icon'] === 'mail')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary group-hover:text-primary-foreground transition-colors"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    @elseif($info['icon'] === 'map-pin')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary group-hover:text-primary-foreground transition-colors"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    @elseif($info['icon'] === 'clock')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary group-hover:text-primary-foreground transition-colors"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm text-muted-foreground">{{ $info['label'] }}</p>
                                    <p class="font-semibold text-foreground">{{ $info['value'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Map --}}
                    @if(!empty($generalData['google_maps_url']))
                        <div 
                            x-data="{ shown: false }"
                            x-intersect.once="shown = true"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            class="mt-8 rounded-xl overflow-hidden shadow-lg transition-all duration-700 ease-out"
                        >
                            <iframe
                                src="{{ $generalData['google_maps_url'] }}"
                                width="100%"
                                height="200"
                                style="border: 0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="SD Gases Location"
                            ></iframe>
                        </div>
                    @endif
                </div>

                {{-- Contact Form --}}
                <div 
                    x-data="{ shown: false, loading: false }"
                    x-intersect.once="shown = true"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                    class="lg:col-span-2 transition-all duration-700 ease-out"
                >
                    <div class="bg-card p-8 rounded-2xl shadow-lg border border-border">
                        <h3 class="text-2xl font-display font-bold text-foreground mb-2">
                            Send us a Message
                        </h3>
                        <p class="text-secondary-foreground/70 mb-8">
                            Fill out the form below and we'll get back to you within 24 hours.
                        </p>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" x-on:submit="loading = true">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-foreground mb-2">
                                        Your Name *
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        required
                                        class="w-full px-4 py-3 rounded-lg border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                        placeholder="John Doe"
                                    >
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-foreground mb-2">
                                        Email Address *
                                    </label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        required
                                        class="w-full px-4 py-3 rounded-lg border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                        placeholder="john@example.com"
                                    >
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-foreground mb-2">
                                        Phone Number
                                    </label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        class="w-full px-4 py-3 rounded-lg border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                        placeholder="+977 98XXXXXXXX"
                                    >
                                </div>
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-foreground mb-2">
                                        Subject *
                                    </label>
                                    <select
                                        id="subject"
                                        name="subject"
                                        required
                                        class="w-full px-4 py-3 rounded-lg border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    >
                                        <option value="">Select a subject</option>
                                        <option value="quote">Request a Quote</option>
                                        <option value="expedition">Expedition Inquiry</option>
                                        <option value="medical">Medical Oxygen</option>
                                        <option value="industrial">Industrial Supply</option>
                                        <option value="rental">Equipment Rental</option>
                                        <option value="support">Technical Support</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-foreground mb-2">
                                    Your Message *
                                </label>
                                <textarea
                                    id="message"
                                    name="message"
                                    required
                                    rows="6"
                                    class="w-full px-4 py-3 rounded-lg border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                                    placeholder="Tell us about your requirements..."
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                :disabled="loading"
                                class="w-full md:w-auto px-8 py-4 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center gap-2 shadow-[0_0_20px_rgba(239,68,68,0.3)] hover:shadow-[0_0_30px_rgba(239,68,68,0.5)] transform active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none"
                            >
                                <template x-if="!loading">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                        <span>Send Message</span>
                                    </div>
                                </template>
                                <template x-if="loading">
                                    <div class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Sending...</span>
                                    </div>
                                </template>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
