import './bootstrap';

import Alpine from 'alpinejs';
import getLodash from "lodash/get";
import eachRightLodash from "lodash/eachRight";
import replaceLodash from "lodash/replace";


window.translate = function(string, args){
    let value = getLodash(window.i18n, string);

    eachRightLodash(args, (paramVal, paramKey) => {
        value = replaceLodash(value, `:${paramKey}`, paramVal);
    });

    return value;
}

window.Alpine = Alpine;

Alpine.start();

import { route } from '../../vendor/tightenco/ziggy';
// import route from 'ziggy-js';
import { Ziggy } from './ziggy';

window.route = route;
window.Ziggy = Ziggy;

