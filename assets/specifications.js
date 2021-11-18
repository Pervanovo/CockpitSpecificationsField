App.Utils.renderer.specifications = function (v) {
    return v != null && typeof v === 'object'
        ? '<span class="uk-badge" title="' + v.templateId + '">' + Object.keys(v.values).length + '</span>'
        : '<span class="uk-icon-eye-slash uk-text-muted"></span>';
};