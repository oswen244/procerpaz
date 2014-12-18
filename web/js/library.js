    function famLista(num_id,opcion){
        var num = num_id;
        $.post('familiares', {data: num}).done(function(data) {
            reloadSelect(data,'#fam',opcion)
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
            $(idSelect).append('<option value='+p[0]+" "+p[1]+'>'+p[0]+" "+p[1]+'</option>');
        });
    }
