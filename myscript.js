/*Camilla Piskonen, 0451801
www-sovellukset*/

"use strict";

function appendItem() {
    let note = $("input[name=note]");
    let list = $("ul.list");
    let value = note.val().trim();
    if(value.length > 0) {
        let newNode = $("<li>").addClass("list").appendTo(list);
        newNode.text(note.val());
        newNode.css("visibility", "visible");
        newNode.text(note.val());
        newNode.on("mouseenter mouseleave", function (event) {
            newNode.toggleClass("inside");
        });
    }
    clearInput();
}

function clearInput() {
    let note = $("input[name=note]");
    note.val("");
}

function onHover() {
    this.on("mouseenter mouseleave", function (event) {
        this.toggleClass("inside");
    });
}


function submitNote() {
    $(document).ready(function() {
        $("#submit").click(function(event) {
            $.ajax({
              type: 'POST',
              url: 'submit.php',
              data: $('#noteform').serialize(),
              success: function() {
                console.log("Lisäys onnistui");
                clearInput();
                location.reload();
                },
              error: function() {
                console.log("Lisäys epäonnistui");
              }
            });
        });
    });
}

function deleteNote() {
    $(document).ready(function() {
        $(".button").click(function(event) {
            let id = $(this).val();
            let data = 'id=' + id;
            console.log(data);
            $.ajax({
              type: 'POST',
              url: 'delete.php',
              data: data,
              success: function() {
                console.log("Poisto onnistui");
                location.reload();
                },
              error: function() {
                console.log("Poisto epäonnistui");
              }
            });
        });
    });
}
