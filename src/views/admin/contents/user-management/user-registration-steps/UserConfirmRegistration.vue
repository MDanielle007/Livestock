<template>
    <div
        class="h-28rem mt-2 flex flex-column gap-2 p-6 justify-content-center border-1 border-200 border-round-top-md bg-white"
    >
        <div class="font-bold text-3xl">
            Terms of Service and Privacy Policy
        </div>
        <ScrollPanel
            :pt="{
                root: {
                    style: { width: '100%', height: '280px' },
                    class: 'border-1 border-200 p-3 border-round-md surface-100',
                },
                barY: { class: 'bg-primary' },
            }"
        >
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Tempore delectus laudantium numquam aliquam, dolore culpa quasi
                ex rerum commodi vitae dolorum nesciunt accusamus odit maiores
                non unde quo omnis consequatur? Eius laboriosam omnis eligendi
                quia. Suscipit omnis ipsa quis voluptatibus possimus accusamus
                earum voluptatem unde! Error consequuntur aliquid quis a nam
                cumque consectetur porro vitae quia autem eum dicta provident,
                eveniet cum velit! Illum dolore ipsa impedit blanditiis. Illo
                quae minima maxime. Facilis quos eligendi vero fugiat quae,
                consectetur illo ea in, maxime mollitia odit officia alias animi
                omnis recusandae dicta. Tempore pariatur, quos nisi quasi sit
                voluptatibus doloribus perferendis non necessitatibus quam harum
                laborum voluptatem voluptates saepe dolores qui. Et at vel
                culpa? Aut tenetur suscipit molestiae vitae maxime labore fugiat
                quod doloremque omnis cupiditate ut odit quasi doloribus
                perferendis inventore nobis, modi nam blanditiis et quia
                repudiandae illo fugit repellendus? Quasi rem eum aliquam ut
                explicabo doloremque vel praesentium est, incidunt provident
                voluptatibus sunt, dolore eaque sapiente quo ex! Ut itaque qui
                laborum. Maxime dolore error sequi debitis nemo ex totam nostrum
                ea voluptates magnam recusandae ratione sapiente vitae itaque
                dicta architecto reprehenderit eligendi, esse distinctio
                reiciendis. Minus quidem voluptas excepturi quae provident. Eius
                odio delectus molestias hic necessitatibus quas quae iure
                excepturi aut provident ullam nisi vel sunt et, culpa recusandae
                perferendis adipisci. Officiis exercitationem explicabo
                excepturi quis dignissimos error nulla omnis illum, quibusdam
                ab. Mollitia iure vero tempore nisi, similique sint cum minima
                dicta repellat quis voluptatem ratione provident esse libero
                reprehenderit est voluptate molestiae perspiciatis! Laudantium
                dolores, facere cumque animi ut tempore et accusantium, iste
                necessitatibus, aut nobis error facilis placeat impedit.
                Temporibus eveniet eaque est enim, amet soluta quo optio magnam
                ducimus maiores molestias, animi quia iusto necessitatibus
                aspernatur esse deserunt. At eligendi veniam pariatur,
                architecto accusantium modi porro amet explicabo nesciunt sint
                minus itaque reprehenderit mollitia dolorem maxime similique
                odio? Sit tenetur ullam amet nobis, quisquam optio! Animi optio
                dolorem quod repudiandae. Eos molestias corrupti officiis
                laboriosam eius deleniti at animi accusamus cumque saepe!
                Consequatur, natus non! Vitae sequi molestiae aut dicta
                temporibus iste nulla saepe, numquam tempora asperiores laborum
                delectus voluptate beatae ex deleniti exercitationem at
                voluptatibus, quisquam adipisci optio quae ullam nemo?
                Dignissimos expedita iusto quibusdam ullam soluta, esse officia
                nam ipsam reprehenderit nulla mollitia vitae distinctio
                consequatur cupiditate deserunt quasi! Dolorum nesciunt
                laudantium doloremque magnam saepe minus facilis dicta suscipit
                id. Dicta numquam vitae esse at eos odit voluptatibus sapiente
                repellendus quo ipsam a ab facilis quibusdam recusandae
                necessitatibus voluptate voluptas aut adipisci, nihil inventore.
                Sunt, quod! Nemo quam tempora ab voluptatem inventore. Fuga
                omnis perferendis architecto quo excepturi accusantium maiores
                voluptas, voluptatibus quos rerum nesciunt nostrum soluta rem
                quisquam eveniet beatae veniam at minima odit in illum neque?
                Asperiores in eligendi temporibus, omnis dolorem vel nihil
                dolore. Vel illo provident laboriosam et quasi expedita, nisi
                repudiandae iste doloremque suscipit quos quia odio modi nulla
                eveniet voluptatibus praesentium iusto sunt ipsam pariatur. Quas
                at nihil, illum eum, qui commodi pariatur vitae doloribus harum
                quos unde repellat in reprehenderit placeat est eveniet
                provident praesentium ut neque ducimus magnam. Sit optio
                exercitationem quod officia facere, voluptatum minus molestiae
                tenetur natus at sapiente totam incidunt ipsa mollitia
                asperiores molestias vitae hic libero accusantium eius laborum
                dolore facilis. Dolore iusto accusamus vel aliquid magnam, rem
                consequatur a sunt dignissimos qui rerum suscipit dolorum
                architecto aspernatur, quam nihil, laudantium id sit veniam enim
                recusandae? Omnis tempore totam qui impedit, aliquam
                voluptatibus id eligendi pariatur excepturi numquam, architecto
                quia deserunt dignissimos, obcaecati maxime corporis odio?
                Ipsam, ratione? Fugit, at. Quibusdam et magnam, ad inventore
                omnis vero reiciendis laudantium dolores iure expedita dolorum
                natus provident quaerat perspiciatis sit alias. Labore neque
                maiores sed nulla, fugit voluptate dolore aperiam a ipsum rerum
                mollitia amet iure quod, eaque impedit hic possimus, nihil velit
                non deleniti! Quam similique provident non velit sequi officia
                omnis nulla. Mollitia, modi totam.
            </p>
        </ScrollPanel>
        <div class="flex align-items-center">
            <Checkbox
                v-model="checkTerms"
                inputId="agreedTerms"
                name="agreedTerms"
                :binary="true"
            />
            <label for="agreedTerms" class="ml-2">
                I agree to the Terms of Service and Privacy Policy
            </label>
        </div>
    </div>
    <div
        class="flex justify-content-between p-3 border-1 border-200 border-round-bottom-md bg-white"
    >
        <router-link :to="{ name: 'UserAccountInfoForm' }">
            <Button severity="secondary" outlined label="Prev" />
        </router-link>
        <Button
            icon="pi pi-user-plus"
            :disabled="checkTerms === false"
            label="Register User"
            @click="submitRegistration"
        />
        <Button
            icon="pi pi-undo"
            severity="danger"
            outlined
            label="Reset Form"
            @click="resetUserState"
        />
    </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            checkTerms: false,
        };
    },
    methods: {
        ...mapActions("registration", ["submitRegistration", "resetUserState"]),
    },
};
</script>
<style></style>
