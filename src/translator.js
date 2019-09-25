function translate(keys, arr = window.translations) {
    if (!Array.isArray(keys))
        keys = keys.split('.');

    if (keys.length > 1) {
        let key = keys.shift();
        return translate(keys, arr[key]);
    }
    else
        return arr[keys];
}
