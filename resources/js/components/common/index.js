class Common {
    static makeID() {
        let id = ""
        let chars = "abcdefghijklmnopqrstuvwxyz"
        for( let i=0; i < 5; i++ ) {
            id += chars.charAt(Math.floor(Math.random() * chars.length))
        }
        return id
    }
    static isIDNumber(id) {
        return Number.isInteger(id) && !Number.isNaN(id)
    }
}

export default Common
