function intTinymce(name, height) {
    tinymce.init({
        selector: name,
        height: height,
        theme: 'modern',
        menubar: false,
        statusbar: true,
        entity_encoding: "raw",
        plugins: [
            'link image media code preview autosave paste table anchor lists advlist wordcount moxiemanager code'
        ],
        tools: 'inserttable code',
        toolbar1: 'undo redo localautosave | styleselect | bold italic underline |' +
            'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        toolbar2: 'table | anchor link image media insertfile | code preview | ToggleDefinitionList ToggleDefinitionItem',
        external_plugins: {
            "moxiemanager": "../cdn/plugin.js"
        },
        image_advtab: true,
        image_title: true,
        paste_auto_cleanup_on_paste: true,
        paste_remove_styles: true,
        paste_remove_styles_if_webkit: true,
        paste_strip_class_attributes: 'all',
        browser_spellcheck: true,
        relative_urls: 'true',
        remove_script_host: 'true',
        allow_script_urls: true,
        verify_html: false
    });
}

function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
    var from = "ấầẩẫậăắằẳẵặàáảãạäâèéẻẽẹëêếềểễệìíỉĩịïîýỳỷỹỵòóỏõọöôồốổỗộơớờởỡợùúủũụüưửữứừựûñçđ·/_,:;";
    var to = "aaaaaaaaaaaaaaaaaaeeeeeeeeeeeeiiiiiiiyyyyyoooooooooooooooooouuuuuuuuuuuuuncd------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-'); //
    return str;
}

function select2_to_val_json(val) {
    var arr = [];
    for (j = 0; j < val.length; j++) {
        arr.push(val[j].id);
    }
    return JSON.stringify(arr);
}

function isNULLorEmpty(v) {
    let type = typeof v;
    if (type === 'undefined') {
        return true;
    }
    if (type === 'boolean') {
        return !v;
    }
    if (v === null) {
        return true;
    }
    if (v === undefined) {
        return true;
    }
    if (v instanceof Array) {
        if (v.length < 1) {
            return true;
        }
    } else if (type === 'string') {
        if (v.length < 1) {
            return true;
        }
        if (v === '0') {
            return true;
        }
    } else if (type === 'object') {
        if (Object.keys(v).length < 1) {
            return true;
        }
    } else if (type === 'number') {
        if (v === 0) {
            return true;
        }
    }
    return false;
}

function isNULLorEmptyNumBer(v) {
    let type = typeof v;
    if (type === 'undefined') {
        return true;
    }
    if (type === 'boolean') {
        return !v;
    }
    if (v === null) {
        return true;
    }
    if (v === undefined) {
        return true;
    }
    if (v instanceof Array) {
        if (v.length < 1) {
            return true;
        }
    } else if (type === 'string') {
        if (v.length < 1) {
            return true;
        }
    } else if (type === 'object') {
        if (Object.keys(v).length < 1) {
            return true;
        }
    }
    return false;
}
