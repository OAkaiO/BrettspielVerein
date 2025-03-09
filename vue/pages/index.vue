<template>
  <ImageContainer :variant="1">
    <WelcomeBanner></WelcomeBanner>
  </ImageContainer>

  <Section :title="'Über uns'">
    <div>
      Wir treffen uns 1x im Monat jeweils an einem Freitagabend im Spittelhof
      Zofingen und spielen Brettspiele jeder Art. Von gehobenen Familienspielen,
      bis mehrstündigen Expertenspielen ist für Jeden etwas dabei!
      Spielerfahrung ist von Vorteil, aber absolut nicht erforderlich. Die
      Teilnahme an unserem Spieleabend steht allen Altersgruppen offen. Bei uns
      werden einige Spiele zur Verfügung gestellt und erklärt. Es dürfen aber
      sehr gerne auch eigene Spiele mitgebracht werden! Perfekt also für alle,
      die zu Hause wegen fehlenden Mitspielern noch ungespielte Spiele rumliegen
      haben, die schon lange wieder mal ein bestimmtes Spiel spielen wollten und
      natürlich auch für alle anderen, die einfach gerne Spiele spielen.
    </div>
  </Section>

  <ImageContainer :variant="2">
    <div>
      <h1>Abonniere unseren Newsletter</h1>
      <p>Sei stets informiert über die nächsten Events!</p>
      <NewsletterForm class="mt-4"></NewsletterForm>
    </div>
    <template #right>
      <WhatsappCode></WhatsappCode>
    </template>
  </ImageContainer>
  <v-container>
    <Section title="Vereinsmitgliedschaft">
      <VRow>
        <VCol>
          <h2 class="mb-4">Mitglieschaftsvorteile</h2>
          <MembershipTable></MembershipTable>
        </VCol>
        <VCol>
          <h2 class="mb-4">Anmeldung Mitgliedschaft</h2>
          <SignUpForm></SignUpForm>
        </VCol>
      </VRow>
    </Section>
    <Section title="Die nächsten Veranstaltungen">
      <EventCard
        :data="{
          title: 'Brettspielabend im Spittelhof',
          date: '05 April',
          time: '19:00',
          location: 'Spittelhof',
          price: '5.-',
        }"
      ></EventCard>
    </Section>
    <Section title="Kontakt">
      <VRow>
        <VCol>
          <h2 class="mb-2">Fragen?</h2>
          <QuestionForm></QuestionForm>
        </VCol>
        <VCol>
          <h2 class="mb-2">Wo spielen wir?</h2>
          <MapWrapper></MapWrapper>
        </VCol>
      </VRow>
    </Section>
  </v-container>
</template>
