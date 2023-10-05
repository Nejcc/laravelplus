// registerComponents.js


import NavbarComponent from "@/components/NavbarComponent.vue";


export default function registerComponents(app) {
    app.component('vue-navbar', NavbarComponent);
}