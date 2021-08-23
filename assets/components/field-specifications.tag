<field-specifications>
    <div class="uk-position-relative" if="{!opts.template_collection}">
        <em>No template_collection option set!</em>
    </div>
    <div class="uk-position-relative" if="{opts.template_collection}">
        <div class="uk-width-1-1 uk-margin-bottom" show="{templates.length > 0}">
            <label title="{templateId}">
                <span class="uk-text-bold">Template: </span>
                <select name="template" onchange="{this.templateSelect}" bind="templateId">
                    <option value="" if="{!templateId}"/>
                    <option each="{t in templates}" value="{t.id}">{t.name}</option>
                </select>
                <em if="{!templateId}">No template selected!</em>
            </label>
        </div>
        <div each="{attrib in template.attributes}" class="uk-grid">
            <div class="uk-width-1-1">
                <label for="{attrib.id}" title="{attrib.id}" class="uk-text-bold">
                    {attrib.name}
                </label>
                <input id="{attrib.id}" type="text" class="uk-width-1-1" bind="values[{attrib.id}]"
                       title="{attrib.name}" list="{'list_' + attrib.id}" onchange="{this.trimInput}"/>
                <datalist id="{'list_' + attrib.id}">
                    <option each="{suggestion in suggestions[attrib.id]}" value="{suggestion}"/>
                </datalist>
            </div>
        </div>
    </div>
    <script>
        var $this = this;

        riot.util.bind(this);

        this.templateId = undefined;
        this.values = {};

        this.template = {};
        this.templates = [];
        this.suggestions = {};

        this.$updateValue = function (value) {
            // console.log("$updateValue", value);
            if (value && value.templateId) {
                $this.templateId = value.templateId;
                if (!Array.isArray(value.values)) {
                    $this.values = value.values || {};
                }
                $this.update();
            }
        };

        this.on('update', function () {
            if ($this.templates.length > 0 && $this.templateId) {
                $this.template = _.find($this.templates, {id: $this.templateId}) || {};
            }
        });

        this.on('bindingupdated', function () {
            // console.log("bindingupdated");
            var values = this.values;
            Object.keys(values).forEach(function (attrib) {
                values[attrib] = values[attrib].toString().trim();
                if (!values[attrib]) {
                    delete values[attrib];
                }
            });
            this.$setValue({
                templateId: this.templateId,
                values: values
            });
            $this.update();
        });

        this.on('mount', function () {
            if ($this.opts.template_collection) {
                var fieldname = opts.bind.replace(/^_?entry\./, "");
                var collection = $this.$boundTo.collection.name;

                App.request('/specifications/templates/' + $this.opts.template_collection).then(function (response) {
                    // console.log("template_collection", response);
                    $this.templates = response.templates;
                    $this.update();
                });

                App.request('/specifications/values/' + collection + "/" + fieldname).then(function (response) {
                    // console.log("suggestions", response);
                    $this.suggestions = response;
                    $this.update();
                });
            }
        });

        this.templateSelect = function (e) {
            var newTemplate = _.find($this.templates, {id: e.target.value}) || {};
            // update value and copy data on attributes with same names
            if ($this.templateId && newTemplate.id) {
                var values = $this.values;
                var oldTemplate = $this.template;
                if (oldTemplate.attributes && newTemplate.attributes) {
                    oldTemplate.attributes.forEach(function (oldAttr) {
                        var newAttr = _.find(newTemplate.attributes, {name: oldAttr.name});
                        if (newAttr && values[oldAttr.id]) {
                            values[newAttr.id] = values[oldAttr.id];
                            delete values[oldAttr.id];
                        }
                    });
                }
            }
            $this.update();
            $this.$boundTo.$bindUpdate();
        };

        this.trimInput = function (e) {
            // console.log("trim", e);
            e.target.value = e.target.value.toString().trim();
        }
    </script>
</field-specifications>
