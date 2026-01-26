@extends('layouts.app')

@section('content')
    <x-page-hero 
        title="About SD Gases" 
        subtitle="Nepal's trusted partner for high-quality oxygen solutions since 2010" 
        :breadcrumbs="[['label' => 'About Us']]"
    />

    {{-- Mission & Vision --}}
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-card p-8 rounded-2xl shadow-lg border border-border">
                    <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-primary"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-foreground mb-4 font-display">Our Mission</h2>
                    <p class="text-muted-foreground leading-relaxed">
                        To provide Nepal with the highest quality oxygen solutions for mountaineering, 
                        medical, and industrial applications. We are committed to safety, reliability, 
                        and supporting life-saving operations across the Himalayas and beyond.
                    </p>
                </div>

                <div class="bg-card p-8 rounded-2xl shadow-lg border border-border">
                    <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-primary"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-foreground mb-4 font-display">Our Vision</h2>
                    <p class="text-muted-foreground leading-relaxed">
                        To be the leading oxygen solutions provider in the Himalayan region, 
                        recognized for excellence in service, innovation in technology, and 
                        unwavering commitment to the safety of mountaineers and patients alike.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Company History --}}
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-primary"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/></svg>
                    <span class="text-primary font-semibold uppercase tracking-wider text-sm">Our Journey</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-foreground font-display">
                    A Legacy of Excellence
                </h2>
            </div>

            <div class="relative max-w-3xl mx-auto">
                {{-- Timeline line --}}
                <div class="absolute left-4 md:left-1/2 transform md:-translate-x-1/2 w-0.5 h-full bg-primary/20"></div>
                
                <div class="space-y-12">
                    @php
                        $milestones = [
                            ['year' => '2010', 'title' => 'Company Founded', 'desc' => 'SD Gases established in Patan Dhoka, Lalitpur'],
                            ['year' => '2012', 'title' => 'First Himalayan Expedition', 'desc' => 'Supplied oxygen for Mount Everest expedition'],
                            ['year' => '2015', 'title' => 'Helicopter Rescue Partner', 'desc' => 'Became official partner for helicopter rescue operations'],
                            ['year' => '2018', 'title' => 'Medical Gas Division', 'desc' => 'Expanded to medical oxygen supply'],
                            ['year' => '2020', 'title' => 'COVID-19 Response', 'desc' => 'Played vital role in medical oxygen supply during pandemic'],
                            ['year' => '2023', 'title' => 'Nationwide Presence', 'desc' => 'Established distribution network across Nepal'],
                        ];
                    @endphp

                    @foreach($milestones as $index => $milestone)
                        <div class="relative flex md:justify-center items-center group">
                            {{-- Dot --}}
                            <div class="absolute left-4 md:left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-background z-10 group-hover:scale-125 transition-transform"></div>
                            
                            {{-- Content --}}
                            <div class="ml-12 md:ml-0 md:w-1/2 {{ $index % 2 == 0 ? 'md:pr-12 md:text-right' : 'md:pl-12 md:order-last' }} w-full">
                                <div class="bg-card p-6 rounded-xl shadow-sm border border-border hover:shadow-md transition-shadow">
                                    <span class="text-primary font-bold text-xl mb-2 block">{{ $milestone['year'] }}</span>
                                    <h3 class="font-bold text-lg mb-2">{{ $milestone['title'] }}</h3>
                                    <p class="text-muted-foreground text-sm">{{ $milestone['desc'] }}</p>
                                </div>
                            </div>
                            
                            {{-- Empty half for desktop alignment --}}
                            <div class="hidden md:block md:w-1/2"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
