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
    static processClaims(id, claims) {
        const processed = {}
        Object.keys(claims).map((result) => {
            processed[result] = claims[result].indexOf(id)
        })
        return processed
    }
}

export default Common
