
(window.jQuery)
    (function ($) {
        'use strict';
        init();
        
        let url = window.location.href;
        let params = getUrlParams(url);
        let username = $("#username").val();

        $('#count-chat').remove();

        Echo.private('App.Models.User.' + username)
            .listen('SendChat', (user) => {
                console.log(user);
                // if (user.username == username) {
                //     loadChats();
                //     handleLeftMessage(user, avatar)
                //     chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, "slow");
                // }
            })
            .error((error) => {
                console.error(error);
            });
    })

var chatBox = $("#my-conversation");
function init() {
    $(".searchTerm").on('input', filter);

    $('[data-chat-input]').on('keypress', function (e) {
        if (e.which == 13) {
            sendMessage(this)
        }
    });

    $('#send-button').on('click', function (e) {
        sendMessage(this)
    });

    joinChat();
}

function joinChat() {
    document.querySelectorAll(".friend").forEach(function (el) {
        el.addEventListener("click", function () {
            if (! $(el).parent().hasClass('focus')) {
                let chatId = $(el).data("chat-id");
                let username = $(el).data("username");
                let name =  $(el).data("name");
                let type =  $(el).data("type");
                let avatar =  $(el).data("avatar");
    
                $("#chat-id").val(chatId);
                checkChat(chatId, username, type, name, avatar);
    
                $(el).parent().addClass('focus');
                
                $(el).on('blur', function() {
                    $(el).parent().removeClass('focus');
                });
            }
        });
    });
}

function filter(e) {
    var lists = document.querySelectorAll(".chat-user-list");

    if (lists.length > 0) {
        for (var i = 0; i < lists.length; i++) {
            if (lists[i].getElementsByClassName("text-master").item(0).innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                lists[i].style.display = "";
            } else {
                lists[i].style.display = "none";
            }
        }
    } else {
        var list = document.querySelector(".chat-user-list");
        
        list.innerHTML = '<div class="empty-chat">No results</div>';
    }
}
function showHideChatBox(show) {
    if (show == true) {
        $('.empty-chat').addClass('hidden')
        $('.main-chat').removeClass('hidden')
    } else {
        $('.main-chat').addClass('hidden')
        $('.empty-chat').removeClass('hidden')
    }
}

function checkChat(chatId, username, type, name, avatar) {
    const url = $("#chat-url").val();
    const token = $("meta[name='csrf-token']").attr("content");

    let users = [{
        username: username,
        type: type
    }];

    $.ajax({
        url: url,
        type: "POST",
        data: {
            "_token": token,
            "chat_id": chatId,
            "users": users,
        },
        success: function (response) {
            if (response.success) {
                var chat = response.data;

                loadMessages(chatId, username, name, avatar);
                showHideChatBox(true);
                $(`.count-chat${chatId}`).remove();

                Echo.join(`chat.${chatId}`)
                    .here((users) => {
                        console.log('success joining chat!');
                        // Echo.leave(`chat.${chatId}`);
                    })
                    .listen('SendChat', (user) => {
                        console.log(user.username, username);
                        if (user.username == username) {
                            loadChats();
                            handleLeftMessage(user, avatar)
                            chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, "slow");
                        }
                    })
                    .joining((user) => {
                        console.log(user.name);
                    })
                    .leaving((user) => {
                        console.log(user.name);
                    })
                    .error((error) => {
                        console.error(error);
                    });
            }
        }
    });
}

function loadMessages(chatId, friendUsername, friendName, friendAvatar) {
    chatBox.empty();

    var assetImageUrl = $("#asset-toko-image-url").val();
    
    let url = $("#load-messages").val();
    url = url.replace(":chat", chatId);

    $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
            if (response.success) {
                var data = response.data;

                // Group pesan berdasarkan tanggal
                var messagesByDate = new Map();

                data.forEach(element => {
                    let messageDate = new Date(element.created_at);
                    let formattedDate = messageDate.toISOString().split('T')[0];

                    let today = new Date();
                    let isToday = messageDate.toDateString() === today.toDateString();

                    if (isToday) {
                        formattedDate = 'today';
                    }

                    if (!messagesByDate.has(formattedDate)) {
                        messagesByDate.set(formattedDate, []);
                    }

                    messagesByDate.get(formattedDate).push(element);
                });

                messagesByDate.forEach((messages, date) => {
                    if (date === 'today') {
                        chatBox.append(`
                            <div class="message-date">
                                <span>Hari Ini</span>
                            </div>
                        `);
                    } else {
                        let messageDate = new Date(messages[0].created_at);
                        let options = { day: '2-digit', month: 'short', year: 'numeric' };
                        let messageDateFormatted = messageDate.toLocaleDateString('id-ID', options);
                        chatBox.append(`
                            <div class="message-date">
                                <span>${messageDateFormatted}</span>
                            </div>
                        `);
                    }

                    messages.forEach(element => {
                        if (element.username == friendUsername) {
                            handleLeftMessage(element, assetImageUrl + '/' + element.user.toko.foto_toko);
                        } else {
                            chatBox.append(`
                                <div class="message clearfix">
                                    <div class="chat-bubble from-me">
                                        <span class="chat-message">${element.message}</span> 
                                        <span class="chat-time">${element.message_time_format}</span>
                                    </div> 
                                </div>`
                            );
                        }
                    });
                });

                chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, "slow");
            } else {
                $("#my-conversation").html('<div class="empty-chat">No messages yet</div>');
            }
        },
        error: function (error) {
            console.error("Error loading messages:", error);
        },
        complete: function () {
            $("#friend-username").val(friendUsername);
            $(".friend-name").text(friendName);
            $(".img-toko").html(`<img width="34" height="34" alt="" src="${friendAvatar}" onerror="this.src='${$('#default-photo-url').val()}';" class="col-top img-toko">`);
        }
    });
}

function sendMessage(element) {
    if ($('[data-chat-input]').val() != '') {
        const url = $("#save-chat-url").val();

        if ($('#chat-id').val() != '') {
            var data = {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "chat_id": $('#chat-id').val(),
                "message": $('[data-chat-input]').val(),
            }
        } else {
            var data = {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "chat_id": $('#chat-id').val(),
                "users": [{
                    "username": $('#friend-username').val(),
                    "type": "penjual"
                }],
                "message": $('[data-chat-input]').val(),
            }
            
            $(".no-message").remove();
        }

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (response) {
                if (response.success) {
                    var data = response.data;
                    var el = $(element).attr('data-chat-conversation');

                    $(el).append(`
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                <span class="chat-message">${data.message}</span> 
                                <span class="chat-time">${data.message_time_format}</span>
                            </div>
                        </div>`
                    );
                    $('[data-chat-input]').val('');
                    $("#chat-id").val(data.chat_id);

                    chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, "slow");
                    loadChats();
                }
            }
        })
    }
}

function loadChats() {
    $(".list-view-group").empty();
    const url = $("#load-chat-url").val();
    $.ajax({
        type: "GET",
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function (data) {
            $(".list-view-group").html(data);
            joinChat();
        },
    });
}

function handleLeftMessage(element , avatar) {
    let html = `
        <div class="message clearfix">
            <div class="profile-img-wrapper m-t-5 inline">
                <img class="col-top" width="30" height="30"
                    src="${avatar}" alt="">
            </div>
            <div class="chat-bubble from-them">
                <span class="chat-message">${element.message}</span> 
                <span class="chat-time">${element.message_time_format ?? element.time}</span>
            </div>
        </div> 
    `;

    var chatBody = $("#my-conversation");
    chatBody.append(html);
}

function getUrlParams(url) {
    var params = {};
    var parser = document.createElement('a');
    parser.href = url;
    var query = parser.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        params[pair[0]] = decodeURIComponent(pair[1]);
    }
    return params;
}