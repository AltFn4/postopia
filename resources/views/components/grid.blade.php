<div style="display: grid;
  grid-template-areas:
    'header header  header  header  right  right'
    'menu   main    main    main    main    main'
    'menu   footer  footer  footer  footer  footer';
  gap: 10px;
  padding: 10px;">
  {{ $slot }}
</div>