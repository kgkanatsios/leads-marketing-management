# Leads Management SPA

This SPA is built with Vite + VueJS.

## Project Setup

### Installation

```sh
npm install
```

### Initial Configuration

```sh
cp .env.example .env
```

Set the value of `VITE_SERVER_API_BASE_URL` variable.

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```

## Packages

In order to cover our project needs, I used some extra NPM packages in VueJS SPA:

- **Axios**: I used Axios as HTTP Client to interact with the Larave API.
- **Penia**: I used Penia for the state management.
- **Vue I18n**: I used Vue I18n to manage locale messages.
- **Vue Router**: I used Vue Router as router for the SPA.

## Styles

For the styling of this SPA, I used the [**Tailwind CSS**](https://tailwindcss.com/).

## UI components

A detailed overview of the majority of the UI components exists on the Home page.

Briefly overview:

- Layout:
  - `<AppLayout>` wraps the whole content of SPA and provides the main layout.
  - `<LayoutContainer>` wraps the main content of each page. By using this component, we are defining the max width of each view content depending on the screen size.
  - `<AppHeader>` contains the header of SPA.
- Alerts:
  - `<SuccessAlert>`: Alert for success messages.
  - `<DarkAlert>`: Alert for failure messages.
  - `<DangerAlert>`: Alert for info/neutral messages.
- Buttons:
  - `<PrimaryButton>`: The primary button. Usually, we use this button as CTA button in the SPA.
  - `<DangerButton>`: The danger button. Usually, we use this button as ghost button in the SPA.
  - `<FloatingButton>`: This is a fixed button and I use it in the bottom right corner of each page.
- Forms:
  - `<InputCheckbox>`: A checkbox element with an additional label.
  - `<InputText>`: An input field element with an additional label.
- Modals:
  - `<BackgroundOverlay>` provides a background overlay for our modals. This component applies a dark background and is used to close the modal if user clicks on it.
  - `<ModalContainer>` wraps the main content of each modal and provides a basic layout (title, body, footer).
  - `<LeadDelete>`: This modal informs the admin that a Lead will be deleted from our DB and confirms the deletion action.
  - `<LeadForm>`: This modal is used to add new leads in our DB or update an existing Lead's data.
