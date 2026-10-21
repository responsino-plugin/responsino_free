/**
 * Config definitions, options, and templates for Responsino FormBuilder
 */

let fieldTypesConfig = '';
let formTemplates = '';
let upgradeUrl = 'https://responsino.de';
let locale = 'en_GB';
if (typeof responsinoFormBuilder !== "undefined") {
    fieldTypesConfig = responsinoFormBuilder.fieldTypesConfig || '';
    formTemplates = responsinoFormBuilder.formTemplates || '';
    locale = responsinoFormBuilder.locale || 'en_GB';
}

if (typeof responsinoAdmin !== "undefined") {
    locale = responsinoAdmin.locale || 'en_GB';
}

export const config = {
    upgradeUrl: upgradeUrl,
    locale: locale,
    localeV2: locale.replace('_', '-'),
    CONTEXT: {
        get currentUrl() { return window.location.pathname; },
        get currentPostType() { return (typeof responsinoFormFrontend !== "undefined" && responsinoFormFrontend.postType) ? responsinoFormFrontend.postType : ''; },
        get currentDevice() { return window.matchMedia("(max-width: 767px)").matches ? 'mobile' : 'desktop'; },
        get isFrontpage() { return !!(typeof responsinoFormFrontend !== "undefined" && responsinoFormFrontend.isFrontpage); }
    },
    FIELD_TYPES_CONFIG: fieldTypesConfig,
    FORM_TEMPLATES: formTemplates
};
