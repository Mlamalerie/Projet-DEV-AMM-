        $(".album-poster").on('click',function(e){
            var dataSwitchId = $(this).attr('data-switch');
            ap.list.switch(dataSwitchId);
            ap.play();
            $("#aplayer").addClass('showPlayer');
        });


const ap = new APlayer({
            container: document.getElementById('aplayer'),
            listFolded: true,
            audio: [
            /*****TENDANCES*****/
            
        });