import $ from 'jquery'

window.$ = $
window.jQuery = $
require("select2");

import tippy from 'tippy.js';
import 'tippy.js/dist/svg-arrow.css';
window.tippy = tippy

import {Spinner} from 'spin.js/spin.js';
window.Spinner = Spinner

import toastr from 'toastr'
toastr.options = {
  "positionClass": "toast-bottom-right"
}
window.toastr = toastr

import {
  initFormAjax,
} from './helpers'


window.initFormAjax = initFormAjax