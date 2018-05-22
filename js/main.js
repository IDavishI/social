function loadMessages() {
    var chatInfo = window.location.search;
    var chat_id = chatInfo.substr(1, chatInfo.indexOf('&')-1);
    var chatHeader = chatInfo.substr(chatInfo.indexOf('&')+1);
    chatHeader = chatHeader.substr(chatHeader.indexOf('=')+1);
    $('.chat__header').html(chatHeader);
    $.ajax({
        url: '/php/getmessages.php',
        data: chat_id,
        method: 'POST',
        success: function(data) {
            var messages = JSON.parse(data);
            
            $('.chat__inner').html('');

            for (var i = 0; i < messages.length; i++) {
                var element = '<p class="par">' + "<span class='chat__name'>" + messages[i].name + " " + messages[i].surname + "</span> " +
            " " + messages[i].message_date + "<br>" + messages[i].body + "</p>";
                $('.chat__inner').append(element);
            }
            var down = "<div id='down'></div>";
            $('.chat__inner').append(down);

            $('.test').click();
        },
        error: function(data) {
            console.log("Error");
        }
    });
}

function checkChatStatus() {
    var chatInfo = window.location.search;
    var chat_id = chatInfo.substr(1, chatInfo.indexOf('&')-1);
    $.ajax({
        url: '/php/getlastmessage.php',
        data: chat_id,
        method: 'POST',
        success: function(data) {
            if (data == 'unread')
                loadMessages();
        },
        error: function(data) {
            console.log("Error");
        }
    });   
}

$(document).ready(function(){

    function getFormData(form) {
        var data = {};
        var dataArray = $(form).serializeArray();
        for (var i = 0; i < dataArray.length; i++) {
            data[dataArray[i].name] = dataArray[i].value;
        }

        return data;
    }

	// Scroll top smoothly
    $('.top-button').on('click', function () {
        $("html, body").animate({scrollTop: $("#top").offset().top}, 700);
    });

    // Tabs (Master/detail) algorithm
    $('.tablinks').on('click', function(event) {
        event.preventDefault();

        var tablinks = document.getElementsByClassName('tablinks');
        var tabcontents = document.getElementsByClassName('tabcontent');
        
        for (var i = 0; i < tablinks.length; i++) {
            $(tablinks[i]).removeClass('active');
            $(tabcontents[i]).css('display', 'none');
        }

        var current = event.currentTarget;
        $(current).addClass('active');
        var id = ($(current).attr('href')).substring(1);
        $('#'+id).css('display', 'block');

    });

    // Add news

    $('.news__button').on('click', function(event) {
        $(this).hide();
        $('.news__form').show();
    });

    $('.news__form').on('submit', function(event) {

        var dat = $(this).serialize();
        console.log(dat);
        $.ajax({
            url: '/php/regnews.php',
            data: dat,
            method: 'POST',
            success: function(data) {
                var temp = getFormData(event.currentTarget);
                var news = "<p class='par'><span class='news__date'>" + data + "</span><br>" + temp.text + "</p><br>";
                $('.news__block').prepend(news);
            },
            error: function(data) {
                console.log("Error");
            }
        });

        $(this).hide();
        $('.news__button').show();

        return false;
    });

    // Add chat

    $('.chat__button').on('click', function(event) {
        $(this).hide();
        $('.chat__form').show();
    });

    // Send message to the chat

    $('.chat-write__form').on('submit', function(event) {

        var dat = getFormData(event.currentTarget);
        
        $.ajax({
            url: '/php/setmessages.php',
            data: dat,
            method: 'POST',
            success: function(data) {
                $('textarea').val('');
                $('textarea').text('');
                loadMessages();
            },
            error: function(data) {
                console.log("Error");
            }
        });

        return false;
    });

    // Add person to chat

    $('.chat__add').on('click', function(event){

        event.preventDefault();

        $.ajax({
            url: '../php/getallfriends.php',
            method: 'POST',
            data: {},
            success: function(data) {
                var dat = JSON.parse(data);
                var chatInfo = window.location.search;
                var chat_id = chatInfo.substr(1, chatInfo.indexOf('&')-1);
                chat_id = chat_id.substr(chat_id.indexOf('=')+1);

                $.ajax({
                    url: '../php/getparticipants.php',
                    method: 'POST',
                    data: {'chatroom_id': chat_id},
                    success: function(data) {
                        var chatPersons = JSON.parse(data);

                        for (var i = 0; i < dat.length; i++) {
                            for (var j = 0; j < chatPersons.length; j++) {
                                if (chatPersons[j].id == dat[i].id) {
                                    dat.splice(i, 1);
                                    break;
                                }
                            }
                        }

                        $('.chat-add__list').html('');

                        for (var i = 0; i < dat.length; i++) {
                            var element = "<li class='chat-add__item'>"+
                                dat[i].name+" "+dat[i].surname+
                                " <a href='/php/addchatroom.php?chatroom_id="+chat_id
                                +"&friend_id="+dat[i].id+"' class='link chat-add__link'>+</a>"+"</li>";
                            $('.chat-add__list').append(element);
                        }

                        var temp = $('.chat-add__list').html();

                        if (!temp) $('.chat-add__list').html('Нет данных для отображения');

                        $('.chat-add').modal();

                    }, 
                    error: function(data) {
                        console.log(data);
                    }

                });
            },
            error: function(data) {
                console.log(data);
            }
        });

    });

    $('.chat-add__list').on('click', '.chat-add__link', function(event){
        event.preventDefault();
        var href = $(this).attr('href');
        var url = href.substr(0, href.indexOf('?'));
        var param2 = href.substr(href.indexOf('&')+1);
        var param1 = href.substr(href.indexOf('?')+1, href.indexOf('&'));
        param1 = param1.substr(0, param1.indexOf('&'));

        var sendData = {};
        sendData[param1.substr(0, param1.indexOf('='))] = param1.substr(param1.indexOf('=')+1);
        sendData[param2.substr(0, param2.indexOf('='))] = param2.substr(param2.indexOf('=')+1);
        var _self = this;

        $.ajax({
            url: url,
            method: 'GET',
            data: sendData,
            success: function(data) {
                $('.chat-add__list').find(_self).parent().remove();
                var temp = $('.chat-add__list').html();
                if (!temp) $('.chat-add__list').html('Нет данных для отображения');

            },
            error: function(data) {
                console.log(data);
            }
        });

    });

    $('.chat__participants').on('click', function(event){
        event.preventDefault();
        $('.chat-part').modal();
        var chatInfo = window.location.search;
        var chat_id = chatInfo.substr(1, chatInfo.indexOf('&')-1);
        chat_id = chat_id.substr(chat_id.indexOf('=')+1);

        $.ajax({
            url: '../php/getparticipants.php',
            method: 'POST',
            data: {'chatroom_id': chat_id},
            success: function(data) {
                var dat = JSON.parse(data);
                $('.chat-part__list').html('');
                for (var i = 0; i < dat.length; i++) {
                    var element = "<li class='chat-part__item'>"+
                    dat[i].name + " " + dat[i].surname + "</li>";
                    $('.chat-part__list').append(element);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });

    });

    $('.news__delete').on('click', function(event){
        var res = confirm("Are you sure to delete the news?");
        if (res) return true;
        else return false;
    });
    
});
