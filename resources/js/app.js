import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import 'element-plus/lib/theme-chalk/index.css';
import locale from 'element-plus/lib/locale/lang/es';
import componenteEjemplo from "./components/componenteEjemplo";

createApp({
    components: {
        componenteEjemplo,
    }
}).use(ElementPlus, {locale}).mount('#app');
