<template>
    <!-- section inicio -->
    <div class="relative h-screen w-full bg-cover bg-center" :style="{ backgroundImage: `url(${backgroundImage})` }">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center">
            <h1 class="text-7xl font-extrabold font-cursive text-outline-plata sm:text-8xl text-center">
                <span class="inline-block sm:inline mr-5 text-outline-plata">Michel</span>
                <span class="block sm:inline mr-5 text-boda-dorado">&</span>
                <span class="inline-block sm:inline text-outline-plata">Daniel</span>
            </h1>

            <p class="text-4xl mt-2 text-boda-verde_pino font-lovedbytheking text-outline-plata">- ¡Nos Casamos! -</p>
            <img src="https://wedding-invite-naho-alex.vercel.app/img/votes/rings-votes.png" class="h-auto max-w-full rounded-lg w-28 mt-2">
            <p class="text-xl mt-2">Sábado, 26 de abril de 2025</p>
            <p class="mt-4 text-lg">Faltan</p>
            <div class="flex space-x-4 mt-4">
                <div v-for="(time, label) in countdown" :key="label"
                    class="bg-boda-verde_pino p-4 rounded-lg text-center text-boda-marfil">
                    <p class="text-2xl font-bold ">{{ time }}</p>
                    <p class="text-sm">{{ label }}</p>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- section padres  -->
    <!-- Versión para ESCRITORIO -->
    <div class="hidden sm:block min-h-screen flex flex-col items-center justify-center p-8 text-center 
    bg-no-repeat bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1496661415325-ef852f9e8e7c?q=80&w=2127&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">

        <p class="sm:text-4xl text-center mb-6 max-w-5xl glow-text-outline italic">
            El amor nunca se da por vencido, jamás pierde la fe, siempre tiene esperanzas y se mantiene firme en toda
            circunstancia.
        </p>

        <p class="text-lg sm:text-2xl italic mb-8">
            1 Corintios 13:7
        </p>

        <p class="sm:text-2xl mb-6 text-boda-plata glow-text">
            Con la bendición de Dios y nuestros queridos padres
        </p>

        <div class="flex justify-center w-full max-w-4xl ">
            <div class="w-1/2 text-center">
                <p class="sm:text-3xl mt-2">M. Isabel & Jose E.</p>
            </div>
            <div class="w-1/2 text-center">
                <p class="sm:text-3xl mt-2">M. de Jesús & Hipólito</p>
            </div>
        </div>

        <p class="sm:text-2xlmt-8 mb-4">
            Y en compañía de nuestros padrinos
        </p>

        <p class="sm:text-3xl ">
            Huberto & M. del Carmen
        </p>
    </div>

    <!-- Versión para MÓVILES -->
    <div class="block sm:hidden min-h-screen flex flex-col items-center justify-center p-8 text-center mt-4 
    bg-no-repeat bg-center bg-cover"
        style="background-image: url('/images/WhatsApp Image 2025-02-04 at 23.13.38.jpeg');">

        <p class="text-2xl text-center mb-6 max-w-5xl glow-text-outline">
            El amor nunca se da por vencido.
        </p>

        <p class="text-lg italic mb-8 text-white">
            1 Corintios 13:7
        </p>

        <p class="text-xl  mb-6 text-boda-plata glow-text text-white">
            Con la bendición de Dios y nuestros queridos padres
        </p>

        <div class="flex justify-center w-full max-w-4xl text-white  mt-3">
            <div class="w-1/2 text-center ml-4">
                <p class="text-2xl mt-2">M. Isabel & Jose E.</p>
            </div>
            <div class="w-1/2 text-center text-white ml-4">
                <p class="text-2xl mt-2 ml-4">M. de Jesús & Hipólito</p>
            </div>
        </div>

        <p class="text-xl mt-8 mb-4 text-white">
            Y en compañía de nuestros padrinos
        </p>

        <p class="text-2xl  text-white">
            Huberto & M. del Carmen
        </p>
    </div>
    <!--  -->
    <!-- card fotografies -->
    <div class="grid gap-4 mx-4 bg-pink-50 mt-4">
        <div
            class="bg-center bg-no-repeat bg-[url('https://images.unsplash.com/photo-1609151162377-794faf68b02f?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-boda-champagne font-lovedbytheking">
            <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
                <h1
                    class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-boda-terracota md:text-3xl lg:text-6xl text-outline-blue">
                    "Momentos Especiales"</h1>
                <h2
                    class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-boda-terracota md:text-3xl lg:text-6xl text-outline-blue">
                    "Cada foto, un recuerdo eterno 💍"
                </h2>
            </div>
        </div>
        <div class="pink-50 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 mx-4">
            <div v-for="(image, index) in images" :key="index">
                <img :src="image.src" :alt="image.alt" class="h-auto max-w-full rounded-lg">
            </div>
        </div>
    </div>
    <!-- card ubication -->

    <!--  -->
    <!-- section code vestimenta -->
    <div class="bg-white flex flex-col items-center justify-center px-4 py-10">
        <div class="max-w-4xl text-center">
            <h2 class="text-4xl font-semibold text-pink-600 mb-4 font-lovedbytheking">Código de Vestimenta</h2>
            <p class="text-lg text-gray-700 mb-8">
                La novia ha estado esperando toda su vida para usar blanco en su boda, así que por favor, elige
                cualquier otro color para nuestro día especial.
            </p>
            <h3 class="mt-2"><strong>¡Por favor evita negro y blanco!</strong></h3>
        </div>
        <h3 class="mt-4"><strong>Recomendación:</strong></h3>

        <div class="flex flex-col md:flex-row items-center justify-center gap-10 mt-4">
            <div class="text-center">
                <img src="https://invitacionesdigitales.io/storage/customers/1f61fd3d-f0bd-43ab-884c-1f85eeb3aa30/mujeres-dresscode.png"
                    alt="Mujeres" class="w-24 h-24 mx-auto" />
                <p class="text-lg text-brown-700 font-semibold mt-2">Mujeres</p>
            </div>
            <div class="text-center">
                <img src="https://invitacionesdigitales.io/storage/customers/1f61fd3d-f0bd-43ab-884c-1f85eeb3aa30/hombres-dresscode.png"
                    alt="Hombres" class="w-24 h-24 mx-auto" />
                <p class="text-lg text-brown-700 font-semibold mt-2">Hombres</p>
            </div>
        </div>
    </div>
    <!--  -->


    <!-- section questions  -->
    <div class="bg-pink-50 text-dark py-10 px-6 md:px-20">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="https://invitacionesdigitales.io/storage/invitation-types/demos/boda/primer-baile.svg"
                    alt="Icono" class="h-20">
            </div>
            <h2 class="text-3xl font-semibold uppercase tracking-widest font-lovedbytheking text-pink-600">Preguntas
                Comunes</h2>
        </div>
        <div class="max-w-3xl mx-auto space-y-6 ">
            <div v-for="(faq, index) in faqs" :key="index">
                <h3 class="text-lg font-semibold">{{ index + 1 }}. {{ faq.question }}</h3>
                <p v-html="faq.answer" class="text-dark"></p>
            </div>
        </div>
    </div>
    <!--  -->
</template>




<script>
import { ref, onMounted, onUnmounted } from 'vue';
import AOS from 'aos';
import 'aos/dist/aos.css'; // Estilos de AOS

export default {
    setup() {
        const targetDate = new Date('2025-04-26T02:00:00');
        const backgroundImage = ref('https://images.unsplash.com/photo-1496661415325-ef852f9e8e7c?q=80&w=2127&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        const countdown = ref({ dias: 0, horas: 0, minutos: 0, segundos: 0 });
        let interval;

        const updateCountdown = () => {
            const now = new Date();
            const difference = targetDate - now;
            if (difference > 0) {
                countdown.value = {
                    dias: Math.floor(difference / (1000 * 60 * 60 * 24)),
                    horas: String(Math.floor((difference / (1000 * 60 * 60)) % 24)).padStart(2, '0'),
                    minutos: String(Math.floor((difference / (1000 * 60)) % 60)).padStart(2, '0'),
                    segundos: String(Math.floor((difference / 1000) % 60)).padStart(2, '0')
                };
            }
        };

        onMounted(() => {
            updateCountdown();
            interval = setInterval(updateCountdown, 1000);
        });

        onUnmounted(() => {
            clearInterval(interval);
        });

        return { countdown, backgroundImage };
    },
    data() {
        return {
            images: [
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.37.jpeg', alt: 'Image 1', title: 'Image 1', description: 'Description for image 1' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.33.jpeg', alt: 'Image 2', title: 'Image 2', description: 'Description for image 2' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.36 (1).jpeg', alt: 'Image 2', title: 'Image 2', description: 'Description for image 2' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.37 (5).jpeg', alt: 'Image 1', title: 'Image 1', description: 'Description for image 1' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.35 (1).jpeg', alt: 'Image 3', title: 'Image 3', description: 'Description for image 3' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.37 (6).jpeg', alt: 'Image 1', title: 'Image 1', description: 'Description for image 1' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.34 (3).jpeg', alt: 'Image 1', title: 'Image 1', description: 'Description for image 1' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.38 (2).jpeg', alt: 'Image 1', title: 'Image 1', description: 'Description for image 1' },
                { src: '/images/WhatsApp Image 2025-02-04 at 23.13.33 (1).jpeg', alt: 'Image 1', title: 'Image 1', description: 'Description for image 1' },
            ],
            faqs: [
                {
                    question: "¿Cómo debo de vestirme para la ocasión?",
                    answer: "La ceremonia se celebrará en un jardín y el código de vestimenta puede ser formal, semi-formal o casual, según su preferencia."
                },
                {
                    question: "¿Existe disponibilidad de estacionamiento en el lugar del evento?",
                    answer: "Sí, contamos con estacionamiento tanto para la iglesia como para el lugar del evento. El estacionamiento de la iglesia es privado (tiene costo) y está ubicado a aproximadamente 100 metros de la entrada"
                },
                {
                    question: "¿Es posible asistir con niños?",
                    answer: "Por supuesto! Los niños son bienvenidos a nuestra celebración."
                },
                {
                    question: "¿Cómo será la asignación de asientos durante el evento?",
                    answer: "A su llegada, serán recibidos por un anfitrión que les indicará sus lugares asignados."
                },
                {
                    question: "¿Cuál es el clima del evento?",
                    answer: "El clima puede ser fresco durante la noche, por lo que recomendamos llevar algo abrigador para mantenerse cómodo."
                }
            ]
        };
    },
    methods: {
        openLink(url) {
            window.open(url, "_blank");
        }
    }
};
</script>

<style>
body {
    background-color: #fbedff;
}

.font-cursive {
    font-family: 'Dancing Script', cursive;
}

.text-brown-700 {
    color: #8B4513;
}

.text-outline-blue {
    text-shadow: 1px 1px 0 #FAFAFA, -1px -1px 0 #FAFAFA, 1px -1px 0 #FAFAFA, -1px 1px 0 #FAFAFA;
}

.text-outline-plata {
    text-shadow: 1px 1px 0 #FAFAFA, -1px -1px 0 #FAFAFA, 1px -1px 0 #FAFAFA, -1px 1px 0 #FAFAFA;
}

.glow-text-outline {
    font-size: 2rem;
    color: white;
    text-shadow: 0 0 10px #E2725B, 0 0 20px #E2725B, 0 0 30px #E2725B, 0 0 40px #E2725B;
}

.glow-text {
    font-size: 2rem;
    color: white;
    text-shadow: 0 0 10px rgb(240, 240, 255), 0 0 20px rgb(213, 213, 237), 0 0 30px rgb(213, 213, 237), 0 0 40px rgb(213, 213, 237);
}
</style>