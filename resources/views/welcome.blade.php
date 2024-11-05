<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="shortcut icon"
        href="https://res.cloudinary.com/dnsekavtx/image/upload/v1722269637/duhani_icon_gs42tl.jpg" type="image/jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .form-control {
            border-radius: 1rem;
            padding: 1rem;
        }

        .submitUrl {
            background-color: #6dbc08;
            color: white;
            border: none;
            border-radius: 1.2rem;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    </style>


    <title>LevelUp Gaming Market URL Shortener Tool</title>
    <meta name="description"
        content="An internal tool for Duhani Capital to streamline and customize long URLs for internal communication, reporting, and operational efficiency. Secure and reliable URL shortening for internal use only.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="LevelUp Gaming Market URL Shortener Tool">
    <meta property="og:description"
        content="An internal tool for Duhani Capital to streamline and customize long URLs for internal communication, reporting, and operational efficiency. Secure and reliable URL shortening for internal use only.">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="LevelUp Gaming Market URL Shortener Tool">
    <meta name="twitter:description"
        content="An internal tool for Duhani Capital to streamline and customize long URLs for internal communication, reporting, and operational efficiency. Secure and reliable URL shortening for internal use only.">
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
            <!-- Logo Duhani -->
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="https://res.cloudinary.com/dnsekavtx/image/upload/v1722256718/duhani_logo_o95yph.png"
                    alt="Duhani Logo" class="img-fluid" style="width: 200px;">
            </a>

            <!-- Button "Need help?" -->
            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-primary">Need help?</button>
            </div>
        </header>
    </div>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <!-- Success Alert with Short URL -->
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <br>
                        <strong>Your short URL is: </strong>
                        <a href="{{ session('short_url') }}" target="_blank">{{ session('short_url') }}</a>
                        <button class="btn btn-sm btn-secondary"
                            onclick="copyToClipboard('{{ session('short_url') }}')">Copy</button>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                    @endif
                    <script>
                        function copyToClipboard(text) {
                            var tempInput = document.createElement("input");
                            tempInput.style.position = "absolute";
                            tempInput.style.left = "-1000px";
                            tempInput.value = text;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert("Short URL copied to clipboard!");
                        }
                    </script>

                    <!-- Error Alert -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Left Side -->
                    <div class="col-md-6">
                        <h1 class="text-primary">URL Shortener - Simplify and Customize Your Links</h1>
                        <p>Make your long URLs shorter and easier to share with our URL shortening tool. This tool
                            allows you to create custom, manageable short URLs, helping you streamline your links for
                            social media, emails, and other digital campaigns.</p>

                    </div>
                    <!-- Right Side (Form) -->
                    <div class="col-md-6">

                        <form action="{{ route('shortlinks.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your name" name="name">
                            </div>
                            <div class="mb-3">
                                <input type="url" class="form-control" placeholder="URL Links that you want to shorten"
                                    id="url_links" name="url_links">
                            </div>
                            <button type="submit" class="btn submitUrl btn-primary w-100">Short URL</button>
                        </form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h2></h2>
                        <!-- Display total data count in small text to the right -->
                        <span class="text-muted">Total Records: {{ $shortLinks->total() }}</span>
                    </div>

                    <!-- Success Alert with updated Short URL -->
                    @if (session('successEdit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('successEdit') }}
                        <br>
                        <strong>Your updated short URL is: </strong>
                        <a href=" {{ session('short_url') }}" target="_blank">{{ session('short_url') }}</a>
                        <button class="btn btn-sm btn-secondary"
                            onclick="copyToClipboard('{{ session('short_url') }}')">Copy</button>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Script for copying URL to clipboard -->
                    <script>
                        function copyToClipboard(text) {
                            var tempInput = document.createElement("input");
                            tempInput.style.position = "absolute";
                            tempInput.style.left = "-1000px";
                            tempInput.value = text;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand("copy");
                            document.body.removeChild(tempInput);
                            alert("Short URL copied to clipboard!");
                        }
                    </script>

                    <!-- Error Alert for validation failures -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="table-responsive-lg">
                        <table class="table table-hover align-middle custom-table">
                            <thead class="table-header">
                                <tr>
                                    <th>Latest shorten URL</th>
                                    <th style="text-align: right;"></th> <!-- Corrected alignment -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shortLinks as $shortLink)
                                <tr>
                                    <td>
                                        <!-- Format like the screenshot -->
                                        <div style="font-size: 18px; font-weight: bold;">
                                            <span style="color: #6dbc08;">shrt.levelupgamehub.com/</span>{{
                                            $shortLink->short_link }}
                                        </div>
                                        <div style="color: #999; font-size: 12px;">
                                            <a href="{{ $shortLink->url_links }}" target="_blank"
                                                style="color: #999;">{{ $shortLink->url_links }}</a>
                                        </div>
                                        <div style="color: #999; font-size: 12px;">
                                            <!-- Icon for user -->
                                            <i class="fas fa-user"></i> {{ $shortLink->name }}
                                            <!-- Icon for Jira ticket, if it exists -->
                                            @if($shortLink->jira_ticket)
                                            &nbsp;| <i class="fas fa-ticket-alt"></i>
                                            <a href="https://emamarkets.atlassian.net/browse/{{ $shortLink->jira_ticket }}"
                                                target="_blank" style="color: #999;">{{ $shortLink->jira_ticket }}</a>
                                            @endif
                                            <!-- Icon for date -->
                                            &nbsp;| <i class="fas fa-calendar-alt"></i> {{
                                            \Carbon\Carbon::parse($shortLink->created_at)->format('d M Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="action-cell" style="text-align: right;">
                                        <!-- Corrected alignment -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item"
                                                        onclick="copyToClipboard('{{ url($shortLink->short_link) }}')">
                                                        <i class="fas fa-copy"></i> Copy
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $shortLink->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('shortlinks.destroy', $shortLink->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>



                                <!-- Modal for editing short URL -->
                                <div class="modal modal-lg fade" id="editModal{{ $shortLink->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $shortLink->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $shortLink->id }}">Edit
                                                    Short URL</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('shortlinks.update', $shortLink->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Input group for Short URL with prefix -->
                                                    <div class="mb-3">
                                                        <label for="short_link" class="form-label">Short URL</label>
                                                        <div class="input-group">
                                                            <!-- Prefix part (you can replace this with your domain) -->
                                                            <span class="input-group-text"
                                                                id="basic-addon3">https://shrt.levelupgamehub.com/</span>
                                                            <!-- Input field for the short link -->
                                                            <input type="text" class="form-control" id="basic-url"
                                                                name="short_link" value="{{ $shortLink->short_link }}"
                                                                aria-describedby="basic-addon3">
                                                        </div>
                                                    </div>

                                                    <!-- Submit button -->
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>


                        <!-- Pagination links -->
                        <div class="d-flex justify-content-center">
                            {{ $shortLinks->links('pagination::bootstrap-4') }}

                            <!-- Laravel pagination links -->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-dark py-4 mt-5">
        <div class="container">
            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-md-10">
                    <p class="mb-0">Copyright © 2024 LevelUp Gaming Market.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
