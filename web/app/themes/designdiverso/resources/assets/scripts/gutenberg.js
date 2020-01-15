wp.domReady(() => {
  wp.blocks.unregisterBlockStyle(
    'core/button',
    ['default', 'outline', 'squared', 'fill']
  );

  wp.blocks.registerBlockStyle(
    'core/button',
    [
      {
        name: 'default',
        label: 'Default',
        isDefault: true,
      },
      {
        name: 'outline',
        label: 'Outline',
      },
    ]
  );
});