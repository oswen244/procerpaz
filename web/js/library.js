    function famLista(num_id,opcion){
        var num = num_id;
        $.post('familiares', {data: num}).done(function(data) {
            reloadSelect(data,'#auxilios-familiar',opcion)
        });
    }

    function reloadSelect(data, idSelect, opcion){
        var x = [];
        $(idSelect).empty();
        $(idSelect).append('<option value="">'+opcion+'</option>');
        $.each(data, function(index, element) {
            var p = new Array();
            $.each(element, function(i, e) {
                p.push(e);
            });
            $(idSelect).append('<option value='+p[0]+'>'+p[1]+" "+p[2]+'</option>');
        });
    }

    function nombreCliente(docInput,idInput,nombreTag)
    {
        $(docInput).on('blur', function(event) {
            $.post('getcliente',{data: $(docInput).val()}).done(function(data) {
                $(idInput).val(data['id_cliente']);
                if($(docInput).val() != '')
                    $(nombreTag).text(data['nombres']+' '+data['apellidos']);
            });
        });
    }

    function valorCuota(monto,intMen,numCuotas)
    {
        monto = parseFloat(monto);
        var cuotaNeto = monto/parseFloat(numCuotas);
        var interes = parseFloat(intMen)/100;
        var valorInteres = monto*interes;
        return cuotaNeto+valorInteres;
    }
