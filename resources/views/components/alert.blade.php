@if(session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Pronto!',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        });
    </script>
@endif
@if( $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let errors = @json( $errors->all() );
            let errorMessage = errors.map(error => `<div>${error}</div>`).join('');

            Swal.fire({
                title: 'ATENÇÃO!',
                html: errorMessage,
                icon: 'error',
                timer: 5000,
                showConfirmButton: false
            });
        });
    </script>
@endif
