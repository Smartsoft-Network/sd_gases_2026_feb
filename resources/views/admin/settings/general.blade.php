@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
<section class="section">
    <div class="section-body">
        <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 text-center mb-4 mt-2">
                    <div class="py-4 bg-light rounded shadow-sm">
                        <h2 class="font-weight-bold text-dark mb-2">General Site Settings</h2>
                        <p class="text-muted mb-0">Configure general site information and appearance.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Site Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Site Name</label>
                                        <input type="text" name="site_name" class="form-control" value="{{ $generalData['site_name'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Email</label>
                                        <input type="email" name="contact_email" class="form-control" value="{{ $generalData['contact_email'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Phone</label>
                                        <input type="text" name="contact_phone" class="form-control" value="{{ $generalData['contact_phone'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ $generalData['address'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Maps Embed URL</label>
                                        <textarea name="google_maps_url" class="form-control" rows="3">{{ $generalData['google_maps_url'] ?? '' }}</textarea>
                                        <small class="text-muted">Paste the <code>src</code> attribute from the Google Maps embed code. Example: <code>https://www.google.com/maps/embed?pb=...</code></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Logo & Favicon</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                        <small class="text-muted">Upload a new logo (SVG, PNG, JPG). Max 2MB.</small>
                                    </div>
                                    @if(isset($generalData['logo']))
                                        <div class="mt-3">
                                            <h6>Current Logo:</h6>
                                            <img src="{{ asset('storage/' . $generalData['logo']) }}" alt="Logo" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Favicon</label>
                                        <input type="file" name="favicon" class="form-control">
                                        <small class="text-muted">Upload a new favicon (PNG, ICO). Max 512KB.</small>
                                    </div>
                                    @if(isset($generalData['favicon']))
                                        <div class="mt-3">
                                            <h6>Current Favicon:</h6>
                                            <img src="{{ asset('storage/' . $generalData['favicon']) }}" alt="Favicon" class="img-thumbnail" style="max-height: 50px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>WhatsApp Numbers</h4>
                        </div>
                        <div class="card-body">
                            <div id="whatsapp-numbers-container">
                                @if(isset($generalData['whatsapp_numbers']) && is_array($generalData['whatsapp_numbers']))
                                    @foreach($generalData['whatsapp_numbers'] as $index => $item)
                                        <div class="whatsapp-number-item-row mb-3 p-3 border rounded bg-light" id="whatsapp-number-{{ $index }}">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('whatsapp-number-{{ $index }}')">&times;</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Label (e.g. Sales, Support)</label>
                                                    <input type="text" name="whatsapp_numbers[{{ $index }}][label]" class="form-control" value="{{ $item['label'] ?? '' }}" required>
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Number (with country code)</label>
                                                    <input type="text" name="whatsapp_numbers[{{ $index }}][number]" class="form-control" value="{{ $item['number'] ?? '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-success" onclick="addWhatsAppNumber()">+ Add WhatsApp Number</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Social Media Links</h4>
                        </div>
                        <div class="card-body">
                            <div id="social-links-container">
                                @if(isset($generalData['social_links']) && is_array($generalData['social_links']))
                                    @foreach($generalData['social_links'] as $index => $link)
                                        <div class="social-link-item mb-3 p-3 border rounded bg-light" id="social-link-{{ $index }}">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('social-link-{{ $index }}')">&times;</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Icon</label>
                                                    <div class="input-group">
                                                        <input type="text" name="social_links[{{ $index }}][icon]" class="form-control" value="{{ $link['icon'] }}" readonly>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-primary" onclick="openIconPicker(this.closest('.input-group').querySelector('input'))">Select Icon</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <label>URL</label>
                                                    <input type="url" name="social_links[{{ $index }}][url]" class="form-control" value="{{ $link['url'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary" onclick="addSocialLink()">+ Add Social Link</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Mail Configuration (SMTP)</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mail Mailer</label>
                                        <input type="text" name="mail_mailer" class="form-control" value="{{ $generalData['mail_mailer'] ?? 'smtp' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mail Host</label>
                                        <input type="text" name="mail_host" class="form-control" value="{{ $generalData['mail_host'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mail Port</label>
                                        <input type="text" name="mail_port" class="form-control" value="{{ $generalData['mail_port'] ?? '587' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mail Username</label>
                                        <input type="text" name="mail_username" class="form-control" value="{{ $generalData['mail_username'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mail Password</label>
                                        <input type="password" name="mail_password" class="form-control" value="{{ $generalData['mail_password'] ?? '' }}">
                                        <small class="text-muted">Leave empty to keep existing password if any.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mail Encryption</label>
                                        <select name="mail_encryption" class="form-control">
                                            <option value="tls" {{ ($generalData['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                            <option value="ssl" {{ ($generalData['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                            <option value="" {{ ($generalData['mail_encryption'] ?? '') == '' ? 'selected' : '' }}>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mail From Address</label>
                                        <input type="email" name="mail_from_address" class="form-control" value="{{ $generalData['mail_from_address'] ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mail From Name</label>
                                        <input type="text" name="mail_from_name" class="form-control" value="{{ $generalData['mail_from_name'] ?? '' }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.icon-picker')

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Inner Page Hero Section</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Inner Hero Image</label>
                                        <input type="file" name="inner_hero_image" class="form-control">
                                        <small class="text-muted">Upload a new image to change the default hero background for inner pages.</small>
                                    </div>
                                    @if(isset($generalData['inner_hero_image']))
                                        <div class="mt-3">
                                            <h6>Current Image:</h6>
                                            <img src="{{ asset('storage/' . $generalData['inner_hero_image']) }}" alt="Inner Hero" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <h6>Default Image:</h6>
                                            <img src="{{ asset('images/hero-bg.jpg') }}" alt="Default Hero" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@include('partials.icon-picker-modal')
@endsection

@push('scripts')
<script>
    let socialLinkIndex = {{ isset($generalData['social_links']) ? count($generalData['social_links']) : 0 }};
    let whatsappNumberIndex = {{ isset($generalData['whatsapp_numbers']) ? count($generalData['whatsapp_numbers']) : 0 }};

    function addSocialLink() {
        const container = document.getElementById('social-links-container');
        const index = socialLinkIndex++;
        const html = `
            <div class="social-link-item mb-3 p-3 border rounded bg-light" id="social-link-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('social-link-${index}')">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Icon</label>
                        <div class="input-group">
                            <input type="text" name="social_links[${index}][icon]" class="form-control" readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary" onclick="openIconPicker(this.closest('.input-group').querySelector('input'))">Select Icon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label>URL</label>
                        <input type="url" name="social_links[${index}][url]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function addWhatsAppNumber() {
        const container = document.getElementById('whatsapp-numbers-container');
        const index = whatsappNumberIndex++;
        const html = `
            <div class="whatsapp-number-item-row mb-3 p-3 border rounded bg-light" id="whatsapp-number-${index}">
                <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement('whatsapp-number-${index}')">&times;</button>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label>Label (e.g. Sales, Support)</label>
                        <input type="text" name="whatsapp_numbers[${index}][label]" class="form-control" required>
                    </div>
                    <div class="col-md-7">
                        <label>Number (with country code)</label>
                        <input type="text" name="whatsapp_numbers[${index}][number]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeElement(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to remove this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(id).remove();
                Swal.fire(
                    'Removed!',
                    'Item has been removed.',
                    'success'
                )
            }
        })
    }
</script>
@endpush
