import './bootstrap';
import  './custom.js';


import 'bootstrap/dist/css/bootstrap.min.css';
import 'select2/dist/css/select2.min.css';
import './bootstrap';
import $ from 'jquery';
import 'select2';

$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap-5'
    });
});

