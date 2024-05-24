using System.Text.Json.Serialization;

namespace Goncermor_Updater.Types
{
    internal class Update
    {
        // Root myDeserializedClass = JsonConvert.DeserializeObject<Root>(myJsonResponse);
        [JsonPropertyName("application_id")]
        public string? AppId { get; set; }
        [JsonPropertyName("channel")]
        public string? Channel { get; set; }
        [JsonPropertyName("name")]
        public string? Name { get; set; }
        [JsonPropertyName("version")]
        public string? Version { get; set; }
        [JsonPropertyName("hash")]
        public string? Hash { get; set; }
    }
}
