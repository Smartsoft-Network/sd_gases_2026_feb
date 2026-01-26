<section id="contact" class="py-24 bg-muted/50 relative overflow-hidden">
    <div class="absolute inset-0 opacity-30 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16" x-data="{ shown: false }" x-intersect.once="shown = true" :class="{ 'opacity-100 translate-y-0': shown, 'opacity-0 translate-y-10': !shown }" class="transition-all duration-700">
            <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary font-medium rounded-full text-sm mb-4">
                Contact Us
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-foreground mb-4">
                Get In <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">Touch</span>
            </h2>
            <p class="text-lg text-muted-foreground">
                Ready to plan your expedition? Contact us for quotes, inquiries, or any questions.
            </p>
        </div>

        <div class="grid lg:grid-cols-5 gap-12">
            {{-- Contact Info --}}
            <div class="lg:col-span-2 space-y-6">
                @php
                    $contactInfo = [
                        ['icon' => 'Phone', 'title' => 'Phone', 'value' => '+01-5533950', 'link' => 'tel:+01-5533950'],
                        ['icon' => 'Mail', 'title' => 'Email', 'value' => 'sdgases.mgmt@gmail.com', 'link' => 'mailto:sdgases.mgmt@gmail.com'],
                        ['icon' => 'MapPin', 'title' => 'Location', 'value' => 'Patan Dhoka, Lalitpur, Nepal', 'link' => '#'],
                        ['icon' => 'Clock', 'title' => 'Hours', 'value' => 'Sun - Fri: 9AM - 6PM', 'link' => '#'],
                    ];
                @endphp

                @foreach($contactInfo as $item)
                    <a href="{{ $item['link'] }}" class="flex items-start gap-4 p-4 rounded-xl bg-card hover:shadow-lg transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary/20 transition-colors">
                            @if($item['icon'] == 'Phone')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-primary"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            @elseif($item['icon'] == 'Mail')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-primary"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            @elseif($item['icon'] == 'MapPin')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-primary"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            @elseif($item['icon'] == 'Clock')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-primary"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-foreground">{{ $item['title'] }}</p>
                            <p class="text-muted-foreground">{{ $item['value'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Map/Form Placeholder --}}
            <div class="lg:col-span-3 bg-card rounded-2xl p-8 shadow-lg border border-border">
                <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium">Name</label>
                            <input type="text" class="w-full px-4 py-2 rounded-lg border border-input bg-background focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Your name">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium">Email</label>
                            <input type="email" class="w-full px-4 py-2 rounded-lg border border-input bg-background focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="your@email.com">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium">Subject</label>
                        <input type="text" class="w-full px-4 py-2 rounded-lg border border-input bg-background focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Inquiry about...">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium">Message</label>
                        <textarea rows="4" class="w-full px-4 py-2 rounded-lg border border-input bg-background focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-primary text-primary-foreground font-semibold rounded-lg hover:bg-primary-dark transition-colors shadow-lg shadow-primary/25">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
