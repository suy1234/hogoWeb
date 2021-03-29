const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

if (mix.inProduction()) {
    mix.version();
}