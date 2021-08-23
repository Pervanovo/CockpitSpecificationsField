App.Utils.renderer.specifications = function (v) {
    return typeof v === 'object' && '<span class="uk-badge" title="' + v.templateId + '">' + Object.keys(v.values).length + '</span>' || "";
};