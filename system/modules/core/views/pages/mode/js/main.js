var getWords = function () {
    $.post('/mode/getWords', function (datas) {

        for (var i = 0; i < datas.length; i++) {
                '<div class="input-group">' +
                '<span class="text-left">' + datas[i].word + '</span>' +
                '<span class="text-right"> I want it. </span> ' +
                '</div>'
        }
    }, 'json');
};

var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
];
$("#suggestons").autocomplete({
    source: availableTags
});

