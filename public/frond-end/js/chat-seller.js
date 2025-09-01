
(window.jQuery)
    (function ($) {
        'use strict';
        init();
    })

var chatBox = $("#chat-content");
function init() {
    $(".searchTerm").on('input', filter);
 
    $('#chat-input').on('keypress', function (e) {
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
            if (! $(el).hasClass('bg-gradient-primary')) {
                let chatId = $(el).data("chat-id");
                let username = $(el).data("username");
                let name =  $(el).data("name");
                let type =  $(el).data("type");
                let avatar =  $(el).data("avatar");
    
                $("#chat-id").val(chatId);
                checkChat(chatId, username, type, name, avatar);
    
                $(el).parent().find('.bg-gradient-primary').removeClass('bg-gradient-primary');

                $(el).addClass('bg-gradient-primary');
            }
        });
    });
}

function filter(e) {
    var lists = document.querySelectorAll(".friend");

    if (lists.length > 0) {
        for (var i = 0; i < lists.length; i++) {
            if (lists[i].getElementsByClassName("text-master").item(0).innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                lists[i].classList.remove("d-none");
            } else {
                lists[i].classList.add("d-none");
            }
        }
    } else {
        $('.empty-user').removeClass('d-none');
    }

    if (document.querySelectorAll(".friend.d-none").length == lists.length) {
        $('.empty-user').removeClass('d-none');
    } else {
        $('.empty-user').addClass('d-none');
    }
}
function showHideChatBox(show) {
    if (show == true) {
        $('.empty-chat').addClass('d-none')
        $('.main-chat').removeClass('d-none')
    } else {
        $('.main-chat').addClass('d-none')
        $('.empty-chat').removeClass('d-none')
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

    var assetImageUrl = $("#asset-avatar-url").val();
    let url = $("#load-messages").val();
    url = url.replace(":chat", chatId);

    $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
            if (response.success) {
                var data = response.data;

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
                            <div class="message-date text-center my-3">
                                <span>Hari Ini</span>
                            </div>
                        `);
                    } else {
                        let messageDate = new Date(messages[0].created_at);
                        let options = { day: '2-digit', month: 'short', year: 'numeric' };
                        let messageDateFormatted = messageDate.toLocaleDateString('id-ID', options);
                        chatBox.append(`
                            <div class="message-date text-center my-3">
                                <span>${messageDateFormatted}</span>
                            </div>
                        `);
                    }

                    messages.forEach(element => {                        
                        if (element.username == friendUsername) {
                            handleLeftMessage(element, assetImageUrl + '/' + element.user.avatar);
                        } else {
                            chatBox.append(`
                                <div class="row justify-content-end text-right mb-4">
                                    <div class="col-auto">
                                        <div class="card bg-gray-200">
                                            <div class="card-body py-2 px-3">
                                                <p class="mb-1">
                                                    ${element.message}
                                                </p>
                                                <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                                                    <i class="fa fa-check text-sm me-1"></i>
                                                    <small>${element.message_time_format}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                            );
                        }
                    });
                });

                chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, "slow");
            } else {
                $("#chat-content").html('<div class="empty-chat">No messages yet</div>');
            }
        },
        error: function (error) {
            console.error("Error loading messages:", error);
        },
        complete: function () {
            $(".friend-name").text(friendName);
            $(".profile").attr("src", friendAvatar);
            $(".avatar").attr("onerror", "this.src='" + $('#default-photo-url').val() + "'");
        }
    });
}


function sendMessage(element) {
    if ($('#chat-input').val() != '') {
        const url = $("#save-chat-url").val();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "chat_id": $('#chat-id').val(),
                "buyer": $('#buyer').val(),
                "message": $('#chat-input').val(),
            },
            success: function (response) {
                if (response.success) {
                    var data = response.data;
                    // var el = $(element).attr('data-chat-conversation');

                    $('#chat-content').append(`
                        <div class="row justify-content-end text-right mb-4">
                            <div class="col-auto">
                                <div class="card bg-gray-200">
                                    <div class="card-body py-2 px-3">
                                        <p class="mb-1">
                                            ${data.message}
                                        </p>
                                        <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                                            <i class="fa fa-check text-sm me-1"></i>
                                            <small>${data.message_time_format}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    );
                    $('#chat-input').val('');

                    chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, "slow");
                    loadChats();
                }
            }
        })
    }
}

function loadChats() {    
    $(".list-friends").empty();
    const url = $("#load-chat-url").val();
    $.ajax({
        type: "GET",
        url: url,
        data: {
            "_token": "{{ csrf_token() }}",
        },

        success: function (data) {
            $(".list-friends").html(data);
            joinChat();
        },
    });
}

function handleLeftMessage(element , avatar) {
    let html = `
        <div class="row justify-content-start mb-4">
            <div class="col-auto">
                <div class="card ">
                    <div class="card-body py-2 px-3">
                        <p class="mb-1">
                            ${element.message}
                        </p>
                        <div class="d-flex align-items-center text-sm opacity-6">
                            <i class="fa fa-check text-sm me-1"></i>
                            <small>${element.message_time_format ?? element.time}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    `;

    var chatBody = $("#chat-content");
    chatBody.append(html);
}