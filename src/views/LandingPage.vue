<template>
    <div class="overflow-hidden">
        <!-- navigation bar -->
        <div
            class="p-3 h-4rem w-full flex justify-content-center"
            style="position: absolute; top: 0"
        >
            <Button label="Home" text />
            <Button label="Livestock" text />
            <Button label="About Us" text />
            <Button label="Events and News" text />
            <Button label="Contact" text />
        </div>

        <!-- first section -->
        <div
            class="min-w-screen min-h-screen flex flex-column justify-content-center align-items-center"
            style="
                background-image: url('images/landingpage/DA.jpg');
                background-repeat: no-repeat;
                background-size: cover;
            "
        >
            <p class="text-6xl m-0 font-semibold text-center text-blue-800">
                Oriental Mindoro Livestock
            </p>
            <p class="text-3xl mt-0 font-bold text-center">
                Integrated Laboratory Division
            </p>
            <Button class="text-center" label="Get Started" rounded />
        </div>

        <!-- second section -->
        <div class="bg-red-300 flex flex-column justify-content-center">
            <p class="text-3xl font-bold text-center">
                Different Type of Livestock
            </p>
            <div
                class="flex gap-6 align-content-start flex-wrap justify-content-center"
            >
                <GoatSVG :width="'100'" :height="'100'" />
                <PigSVG :width="'100'" :height="'100'" />
                <SheepSVG :width="'100'" :height="'100'" />
            </div>
            <div
                class="flex gap-8 align-content-start flex-wrap justify-content-center"
            >
                <p class="text-2xl font-semibold text-center">Goat</p>
                <p class="text-2xl font-semibold text-center">Pig</p>
                <p class="text-2xl font-semibold text-center">sheep</p>
            </div>
            <div
                class="flex gap-6 align-content-start flex-wrap justify-content-center"
            >
                <p class="text-5xl font-semibold text-center mt-0">258</p>
                <p class="text-5xl font-semibold text-center mt-0">415</p>
                <p class="text-5xl font-semibold text-center mt-0">290</p>
            </div>
        </div>

        <div>
            <div
                class="flex gap-5 align-items-center justify-content-center mt-8"
            >
                <Image
                    width="300"
                    height="500"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="300"
                    height="500"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="300"
                    height="500"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="300"
                    height="500"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
            </div>

            <div>
                <p class="text-6xl font-semibold text-center">About Us</p>
                <p class="text-center text-xl px-8">
                    Lorem ipsum dolor sit amet. Aut pariatur magnam ea
                    repudiandae accusamus ab nihil eaque est sint galisum. Ut
                    tempore illum a ipsam distinctio et aliquam reprehenderit
                    eum reiciendis accusamus sed veritatis veritatis non
                    voluptas similique. Sed ducimus ipsa qui dolorem obcaecati
                    vel sint enim et internos magnam At assumenda atque. Sit
                    sunt autem qui excepturi sint eos dolor porro. Ut molestiae
                    dolores et reiciendis velit et nisi tenetur qui animi nobis
                    qui natus quia qui dignissimos fugit. Vel magnam veritatis
                    rem soluta accusamus vel velit esse. Aut consequatur
                    deserunt aut nihil galisum aut alias dolor et aliquam
                    suscipit. Sit beatae vitae ut nulla consequatur sit totam
                    animi quo deserunt tenetur et fugit nihil aut libero dolore
                    ut nihil internos. Et error consequatur ut sint ullam eum
                    tempora inventore eos repellat dignissimos.
                </p>
            </div>
        </div>

        <!-- org chart -->
        <div>
            <p class="text-6xl font-semibold text-center">
                Organizational Chart
            </p>
            <OrgChart />
        </div>

        <!-- advisory -->
        <div
            class="min-w-screen min-h-screen flex flex-column justify-content-center align-items-center"
            style="
                background-image: url('images/landingpage/PIC1.jpg');
                background-repeat: no-repeat;
                background-size: cover;
            "
        >
            <p class="text-6xl font-semibold text-center">ADVISORY</p>
            <div class="flex align-content-start flex-wrap gap-5 mt-0 m-6">
                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />

                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />

                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />
                <Image
                    width="330"
                    height="330"
                    src="/images/landingpage/PIC1.jpg"
                    alt=""
                    :imageStyle="{ objectFit: 'cover' }"
                />

                <Card>
                    <template #title>Simple Card</template>
                    <template #content>
                        <p class="m-0">
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Inventore sed consequuntur error repudiandae
                            numquam deserunt quisquam repellat libero asperiores
                            earum nam nobis, culpa ratione quam perferendis
                            esse, cupiditate neque quas!
                        </p>
                    </template>
                </Card>
            </div>
        </div>

        <!-- events and news -->
        <div>
            <p class="text-5xl font-semibold text-start ml-8 m-0 mt-5">
                EVENTS AND NEWS
            </p>
            <div class="mx-8"> <Divider /></div>
            
            <p class="text-left text-xl px-8">
                Lorem ipsum dolor sit amet. Aut pariatur magnam ea repudiandae
                accusamus ab nihil eaque est sint galisum. Ut tempore illum a
                ipsam distinctio et aliquam reprehenderit eum reiciendis
                accusamus sed veritatis veritatis non voluptas similique. Sed
                ducimus ipsa qui dolorem obcaecati vel sint enim et internos
                magnam At assumenda atque. Sit sunt autem qui excepturi sint eos
                dolor porro. Ut molestiae dolores et reiciendis velit et nisi
                tenetur qui animi nobis qui natus quia qui dignissimos fugit.
                Vel magnam veritatis rem soluta accusamus vel velit esse. Aut
                consequatur deserunt aut nihil galisum aut alias dolor et
                aliquam suscipit. Sit beatae vitae ut nulla consequatur sit
                totam animi quo deserunt tenetur et fugit nihil aut libero
                dolore ut nihil internos. Et error consequatur ut sint ullam eum
                tempora inventore eos repellat dignissimos.
            </p>
        </div>
        <!-- contact us -->
        <div class="flex p-4 justify-content-between align-items-center ">
            <div>
                <p class="text-5xl font-semibold text-start ml-8">CONTACT US</p>
                <p class="text-2xl font-semibold text-start ml-8 my-0">CALL US</p>
                <p class="text-1xl font-semibold text-start ml-8 my-0 ">
                    Lorem ipsum dolor sit amet. Aut sint quibusdam a
                </p>
                <p class="text-2xl font-semibold text-start ml-8 mb-0">LOCATION</p>
                <p class="text-1xl font-semibold text-start ml-8 mt-0">
                    Lorem ipsum dolor sit amet. Aut sint quibusdam a
                </p>
                <p class="text-2xl font-semibold text-start ml-8 mb-0">
                    BUSINESS HOUR
                </p>
                <p class="text-1xl font-semibold text-start ml-8 mt-0 ">
                    Lorem ipsum dolor sit amet. Aut sint quibusdam a
                </p>
            </div>

            <div class="flex justify-content-end flex-wrap ">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15532.794825109757!2d121.2426057!3d13.2755197!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bcebe7743ac49b%3A0x1581f470c333d943!2sDepartment%20of%20Agriculture%20-%20Integrated%20Laboratory%20Division!5e0!3m2!1sen!2sph!4v1709565090072!5m2!1sen!2sph"
                    width="750"
                    height="450"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </div>

        <!-- footer -->
        <div class="bg-red-300 flex flex-column justify-content-center">
            <p class="text-3xl font-bold text-center">FOOTER</p>
        </div>
    </div>
</template>
<script>
import GoatSVG from "@/components/general/svgs/GoatSVG.vue";
import PigSVG from "@/components/general/svgs/PigSVG.vue";
import SheepSVG from "@/components/general/svgs/SheepSVG.vue";
import OrgChart from "@/components/general/OrgChart.vue";
export default {
    components: {
        OrgChart,
        GoatSVG,
        PigSVG,
        SheepSVG,
    },
};
</script>
<style></style>
