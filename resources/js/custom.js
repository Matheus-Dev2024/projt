let inputValor =document.getElementById('valor');


inputValor.addEventListener('input', function (){

    let valueValor = this.value.replace(/[^\d]/g,'');

    var formattedValor = (valueValor.slice(0, -2).replace(/\B(?=(\d{3)+(?!\d))/g, '.')) + valueValor.slice(-2);

    formattedValor = formattedValor.slice(0, -2) + ',' + formattedValor.slice(-2);


});
    $(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: "Selecione"
        });
    });
