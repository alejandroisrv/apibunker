export default [
  {
    _name: 'CSidebarNav',
    _children: [
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'Dashboard',
      //   to: '/dashboard',
      //   icon: 'cil-speedometer',
      // },
      {
        _name: 'CSidebarNavTitle',
        _children: ['Pedidos']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Pedidos',
        to: '/pedidos',
        icon: 'cil-drop'
      }
    ]
  }
]
