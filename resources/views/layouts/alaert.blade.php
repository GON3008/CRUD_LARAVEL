<!-- Add these lines to your head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if(session('msg'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '{{ session('msg') }}',
                width: 650,
                allowOutsideClick: true,
                padding: '3em',
                color: '#716add',
                background: '#fff url({{ asset("uploads/images/img.png") }})',
                backdrop: `
                    rgba(0,0,123,0.4)
                    url("{{ asset("uploads/images/ok.gif") }}")
                    left top
                    no-repeat
                `
            });
        });
    </script>
@endif
