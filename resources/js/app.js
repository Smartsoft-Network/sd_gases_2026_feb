import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import Swal from 'sweetalert2';

window.Swal = Swal;

Alpine.plugin(intersect);
window.Alpine = Alpine;

Alpine.start();
