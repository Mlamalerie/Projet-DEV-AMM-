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
            {
                name: 'Nelson',
                artist: 'CG6',
                url: 'audio/Nelson.mp3',
                cover: 'img/CG6.png'
            },
            {
                name: 'Double Bang 5',
                artist: 'Leto',
                url: 'audio/DB5.mp3',
                cover: 'img/DB5.jpg'
            },
            {
                name: 'Malcolm',
                artist: 'Ninho',
                url: 'audio/Malcolm.mp3',
                cover: 'img/MILS.jpg'
            },
            /********TOP VENTES********/
            {
                name: 'High Fashion (ft.Dj Mustard)', 
                artist: 'Roddy Rich', 
                url: 'audio/high_fashion.mp3',
                cover: 'img/roddy.jpg'
            },
            {
                name: 'Go Legend (ft.Travis Scott)', 
                artist: 'Big Sean & Metro Boomin',
                url: 'audio/go_legend.mp3',
                cover: 'img/bigmetro.jpg'
            },
            {
                name: 'Futsal Shuffle 2020',
                artist: 'Lil Uzi Vert',
                url: 'audio/futsal_shuffle_2020.mp3',
                cover: 'img/luv.jpg'
            }
            ]
        });