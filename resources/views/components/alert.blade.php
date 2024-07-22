@if(session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Pronto!',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif


@if( $errors->any())
        @php
        $mensagem = '';
        foreach($errors->all() as $error) {
            $mensagem = $error . '<br>';
        }
        @endphp

        <script>
            console.log('deu certo')
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'ERROR!',
                    text: "{!! $mensagem !!}",
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
@endif
