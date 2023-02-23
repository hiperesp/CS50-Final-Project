<?php declare(strict_types=1);

namespace app\model;

class OpenGraph extends Model implements \JsonSerializable {

    public function __construct() {
        parent::__construct();
    }
    public static function fromUrl(string $url): OpenGraph {
        try {
            $ch = \curl_init();
            \curl_setopt($ch, CURLOPT_URL, $url);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            \curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            \curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36");
            $html = \curl_exec($ch)?:"";
            \curl_close($ch);
        } catch(\Exception $e) {
            $html = "";
        }
        return OpenGraph::fromHtml($html);
    }

    public static function fromHtml(string $html): OpenGraph {
        $openGraph = new OpenGraph;
        return $openGraph->setHtml($html);
    }

    private ?string $html = null;
    public function setHtml(?string $html): OpenGraph {
        $html = \str_replace('<head>', '<head><meta charset="utf-8">', $html);
        $this->html = $html;
        return $this;
    }
    public function getHtml(): ?string {
        return $this->html;
    }

    private ?string $title = null;
    public function setTitle(?string $title): OpenGraph {
        $this->title = $title;
        return $this;
    }
    public function getTitle(): ?string {
        return $this->title;
    }

    private ?string $description = null;
    public function setDescription(?string $description): OpenGraph {
        $this->description = $description;
        return $this;
    }
    public function getDescription(): ?string {
        return $this->description;
    }

    private ?string $image = null;
    public function setImage(?string $image): OpenGraph {
        $this->image = $image;
        return $this;
    }
    public function getImage(): ?string {
        return $this->image;
    }

    public function extract(): OpenGraph {
        $this->extractTitle();
        $this->extractDescription();
        $this->extractImage();
        return $this;
    }

    public function extractTitle(): OpenGraph {
        $title = @$this->extractTagValues("title")[0];
        $this->setTitle($title);
        return $this;
    }

    public function extractDescription(): OpenGraph {
        $description = @$this->extractTagValues("description")[0];
        $this->setDescription($description);
        return $this;
    }

    public function extractImage(): OpenGraph {
        $image = @$this->extractTagValues("image")[0];
        $this->setImage($image);
        return $this;
    }

    public function extractTagValues(string $tag): array {
        try {
            $dom = new \DOMDocument();
            @$dom->loadHTML($this->getHtml());
            $xpath = new \DOMXPath($dom);
            $nodes = $xpath->query("//meta[@property='og:$tag']");
            $values = [];
            foreach ($nodes as $node) {
                $values[] = $node->getAttribute("content");
            }
            return $values;
        } catch(\Exception $e) {
            return [];
        }
    }

    public function jsonSerialize(): mixed {
        return [
            "title" => $this->getTitle(),
            "description" => $this->getDescription(),
            "image" => $this->getImage(),
        ];
    }

}