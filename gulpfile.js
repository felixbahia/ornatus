var gulp = require('gulp'),
    elixir = require('laravel-elixir');

    elixir(function(mix) {
        mix.less('style.less');
    });
