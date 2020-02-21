export function resolvePlugins(config) {
    const plugins = {}

    Object.entries(config.plugins).map(([name, plugin]) => {
        plugins[name] = plugin(config, config[name])
    })

    return plugins
}
