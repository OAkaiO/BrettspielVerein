<script setup lang="ts">
const alertData: Ref<AlertStatus[]> = ref([
  {
    message: "Hello There",
    type: "success",
  },
  {
    message: "Hello There",
    type: "warning",
  },
  {
    message: "Hello There",
    type: "info",
  },
  {
    message: "Hello There",
    type: "error",
  },
]);
const { repository: eventRepository } = useEventRepository();
const { data } = useLazyAsyncData(() => eventRepository.getEventData(), { server: false });
</script>

<template>
  <div>
    <AlertContainer :alert-data />
    <div ref="home">
      <ImageContainer :variant="1">
        <WelcomeBanner />
      </ImageContainer>
      <Section title="Über uns">
        <div>
          Wir treffen uns 1x im Monat jeweils an einem Freitagabend im Spittelhof Zofingen und spielen Brettspiele jeder Art. Von gehobenen Familienspielen, bis mehrstündigen Expertenspielen ist für Jeden etwas dabei! Spielerfahrung ist von Vorteil, aber absolut nicht erforderlich. Die Teilnahme an unserem Spieleabend steht allen Altersgruppen offen. Bei uns werden einige Spiele zur Verfügung gestellt und erklärt. Es dürfen aber sehr gerne auch eigene Spiele mitgebracht werden! Perfekt also für alle, die zu Hause wegen fehlenden Mitspielern noch ungespielte Spiele rumliegen haben, die schon lange wieder mal ein bestimmtes Spiel spielen wollten und natürlich auch für alle anderen, die einfach gerne Spiele spielen. Wir treffen uns 1x im Monat jeweils an einem Freitagabend im Spittelhof Zofingen und spielen Brettspiele jeder Art. Von gehobenen Familienspielen, bis mehrstündigen Expertenspielen ist für Jeden etwas dabei! Spielerfahrung ist von Vorteil, aber absolut nicht erforderlich. Die Teilnahme an unserem Spieleabend steht allen Altersgruppen offen. Bei uns werden einige Spiele zur Verfügung gestellt und erklärt. Es dürfen aber sehr gerne auch eigene Spiele mitgebracht werden! Perfekt also für alle, die zu Hause wegen fehlenden Mitspielern noch ungespielte Spiele rumliegen haben, die schon lange wieder mal ein bestimmtes Spiel spielen wollten und natürlich auch für alle anderen, die einfach gerne Spiele spielen.
        </div>
      </Section>
      <ImageContainer :variant="2">
        <div>
          <h2>Abonniere unseren Newsletter</h2>
          <div class="pb-4">
            Sei stets informiert über die nächsten Events!
          </div>
          <NewsletterForm />
        </div>
        <template #right>
          <WhatsappCode />
        </template>
      </ImageContainer>
      <Section title="Vereinsmitgliedschaft">
        <div class="dual-slot-container">
          <div class="grow basis-0">
            <MembershipTable />
          </div>
          <BVZSheet class="dual-container-item bg-header rounded-xl">
            <h2 class="text-white mb-3">
              Anmeldung Mitgliedschaft
            </h2>
            <SignUpForm />
          </BVZSheet>
        </div>
      </Section>
      <Section title="Die nächsten Veranstaltungen">
        <BVZSheet
          class="bg-secondary rounded-xl flex flex-col gap-2"
        >
          <EventCard
            v-for="eventData in data"
            :key="eventData.id"
            :data="eventData"
            class="bg-white rounded-xl"
          />
        </BVZSheet>
      </Section>
      <Section title="Kontakt">
        <div class="dual-slot-container">
          <div class="dual-container-item">
            <h2>Fragen?</h2>
            <BVZSheet
              class="bg-secondary rounded-xl"
            >
              <QuestionForm />
            </BVZSheet>
          </div>
          <div class="dual-container-item">
            <h2>Wo spielen wir?</h2>
            <MapWrapper />
          </div>
        </div>
      </Section>
    </div>
  </div>
</template>

<style scoped>
@reference "tailwindcss";

.dual-slot-container {
  @apply flex flex-col md:flex-row gap-2;

  .dual-container-item {
    @apply basis-0 grow max-w-[calc(50%-var(--spacing))];
  }
}
</style>
